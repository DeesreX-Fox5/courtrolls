<?php

namespace Fox5\Component\Courtroll\Site\Model;

defined('_JEXEC') or die('Restricted access');

use Fox5\Component\Courtroll\Site\Table;
use Joomla\CMS\Application\CMSApplicationInterface;
use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\FormModel;
use Joomla\Database\DatabaseInterface;
use Joomla\Filesystem\File;
use Joomla\Input\Input;

/**
 * Model for the file upload
 *
 * @package     Fox5\Component\Courtroll\Site\Model
 *
 * @since       version 4.2.4
 */
class FileModel extends FormModel
{
	/**
	 * Joomla Input object
	 *
	 * @var Input
	 * @since version 4.2.4
	 */
	protected Input $input;

	/**
	 * Joomla Application object
	 *
	 * @var CMSApplicationInterface|null
	 * @since version 4.2.4
	 */
	protected CMSApplicationInterface $app;

	/**
	 * Database object
	 *
	 * @var DatabaseInterface|mixed
	 * @since version 4.2.4
	 */
	protected DatabaseInterface $dbo;

	/**
	 * Table holding all courtroll data
	 *
	 * @var Table\CourtrollTable
	 * @since version 4.2.4
	 */
	protected Table\CourtrollTable $courtrollTable;

	/**
	 * Table holding all Judges
	 *
	 * @var Table\JudgeTable
	 * @since version 4.2.4
	 */
	protected Table\JudgeTable $judgeTable;

	/**
	 * Constructor
	 *
	 * @param $config
	 *
	 * @throws \Exception
	 *
	 * @since version 4.2.4
	 */
	public function __construct($config = array())
	{
		$this->input = new Input();
		$this->app = Factory::getApplication();
		$this->dbo = Factory::getContainer()->get(DatabaseInterface::class);
		$this->courtrollTable = new Table\CourtrollTable($this->dbo);
		$this->judgeTable = new Table\JudgeTable($this->dbo);
		parent::__construct($config);
	}

	/**
	 * Gets the form
	 *
	 * @param $data
	 * @param $loadData
	 *
	 * @return false|\Joomla\CMS\Form\Form
	 *
	 * @throws \Exception
	 * @since version 4.2.4
	 */
	public function getForm($data = [], $loadData = true)
	{
		$form = $this->loadForm('com_courtroll.file', 'file', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) { return false; } return $form;
	}

	/**
	 * Uploads the file
	 *
	 * @since version 4.2.4
	 */
	public function upload()
	{
		$file  = $this->input->files->get('jform')['roll_file'];
		$roll  = $this->input->get('jform', array(), 'ARRAY')['roll'];
		$values = $this->input->get('jform', array(), 'array');
		$src    = $file['tmp_name'];
		$date = $values['date'];
		$dateValidUntil = $values['date_valid_until'];
		$valid = true;

		if($dateValidUntil < $date) {
			$this->app->enqueueMessage('The date valid until must be greater than the date', 'error');
			$valid = false;
		}
		if(!$this->validFile($file)) {
			$this->app->enqueueMessage('The file is not valid', 'error');
			$valid = false;
		}

		if(!$valid) {
			$this->app->redirect('index.php/courtroll?view=file&layout=form');
		}



		$loc = match ($roll)
		{
			"Day Rolls" => "day/",
			"Opposed Motion Roll" => "opposed/",
			"Unopposed Motion Roll" => "unopposed/",
			"Urgent Court Rolls" => "urgent/",
			"Interlocutory Applications" => "interlocutory_applications/",
			"Judicial Management Meetings" => "judicial_management_meetings/",
			"Directives" => "directives/",
			default => "unknown/",
		};

		$dest = '/rolls/' . $loc . $values["date"] . "-" . str_replace(" ", '_', $values["description"]) . ".pdf";

		if (File::upload($src, JPATH_SITE . $dest)) {
			$this->app->enqueueMessage('File successfully uploaded', 'success');
		}

		$id = $this->save($dest);
		$this->saveJudge($id, $values['subform_judge']);
		$this->app->redirect(\JRoute::_('index.php?courtrolls-test&view=courtroll&layout=rolls'));
	}

	/**
	 * Saves the file to the database
	 *
	 * @param $dest
	 *
	 * @return mixed
	 *
	 * @since version 4.2.4
	 */
	public function save($dest)
	{
		$values              = $this->input->get('jform', "Not Found", 'array');
		$values['roll_file'] = $dest;
		$this->courtrollTable->save($values);
		return $this->courtrollTable->id;
	}

	/**
	 * Saves the judges to the database
	 *
	 * @param          $id
	 * @param   mixed  $subformJudge
	 *
	 *
	 * @since version 4.2.4
	 */
	private function saveJudge($id, mixed $subformJudge)
	{
		foreach ($subformJudge as $judge) {
			$saveArray = array(
				'roll_id' => $id,
				'judge'   => $judge["judge"]
			);
			$this->judgeTable->save($saveArray);
		}
	}

	/**
	 * Checks if the file is valid
	 *
	 * @param   mixed  $file
	 *
	 * @return bool
	 *
	 * @since version 4.2.4
	 */
	private function validFile(mixed $file)
	{
		$fileType = $file['type'];
		if (empty($file)) {
			$this->app->enqueueMessage('Empty file field', 'error');
			return false;
		}
		if($fileType == 'application/pdf' || $fileType == 'application/msword'
		|| $fileType == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'){
			return true;
		}
		$this->app->enqueueMessage('Invalid file type', 'error');
		return false;
	}

}
