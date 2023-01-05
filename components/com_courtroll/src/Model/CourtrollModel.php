<?php

namespace Fox5\Component\Courtroll\Site\Model;

defined('_JEXEC') or die('Restricted access');

use Fox5\Component\Courtroll\Site\Table;
use Joomla\CMS;
use Joomla\Database\DatabaseInterface;
use Joomla\Input\Input;

/**
 * @package     Fox5\Component\Courtroll\Site\Model
 *
 * @since       version 4.2.4
 */
class CourtrollModel extends CMS\MVC\Model\FormModel
{
    /**
     * Joomla Input object
     *
     * @var Input
     * @since version 4.2.4
     */
    protected Input $input;

    /**
     * Joomla Database object
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
     * @param $config
     *
     * @throws \Exception
     *
     * @since version 4.2.4
     */
    public function __construct($config = array())
    {
        parent::__construct($config);
        $this->input = new Input();
        $this->dbo = CMS\Factory::getContainer()->get(DatabaseInterface::class);
        $this->courtrollTable = new Table\CourtrollTable($this->dbo);
        $this->judgeTable = new Table\JudgeTable($this->dbo);
    }

    /**
     * Gets all courtrolls with the filter applied
     *
     * @return array|mixed
     *
     * @since version 4.2.4
     */
    public function loadFileCategory(): array
    {
        $filter = $this->input->get('jform', array(), 'ARRAY');
        $filter['category'] = match ($this->input->get('category')) {
            "communique" => "communique",
            "newsletter" => "newsletter",
            default => "courtrolls",
        };

        $rolls = $this->courtrollTable->loadRoll($filter);
        if (!isset($filter["type"])) {
            $rolls = $this->groupRolls($rolls);
        }

        return $rolls;
    }


    /**
     * Gets the form
     *
     * @param $data
     * @param $loadData
     *
     * @return false|CMS\Form\Form
     *
     * @throws \Exception
     * @since version
     */
    public
    function getForm($data = [], $loadData = true)
    {
        $form = $this->loadForm('com_courtroll.filter', 'filter', array('control' => 'jform', 'load_data' => true));
        if (empty($form)) {
            return false;
        }
        return $form;
    }

    /**
     * Groups the Rolls into a multidimensional array
     *
     * @param $rolls
     *
     * @return array
     *
     * @since version 4.2.4
     */
    public
    function groupRolls($rolls)
    {
        $groupedRolls = array();
        foreach ($rolls as $roll) {
            $groupedRolls[$roll->roll][] = $roll;
        }

        return $groupedRolls;
    }

    /**
     * Filters the data
     *
     * @return array|mixed
     *
     * @since version 4.2.4
     */
    public
    function filterData()
    {
        $filter = $this->input->get('roll', array(), 'ARRAY');
        return $this->courtrollTable->loadRoll($filter);
    }

    /**
     * Gets the judge
     *
     * @param $id
     *
     * @return array|mixed
     *
     * @since version
     */
    public
    function getJudge($id)
    {
        return $this->judgeTable->getJudge($id);
    }

    /**
     * Gets the active rolls in the correct category
     *
     * @param $roll
     *
     * @return array|mixed
     *
     * @since version
     */
    public
    function getActiveRolls($roll)
    {
        return $this->courtrollTable->getActiveRolls($roll);
    }

    public
    function delete(int $id)
    {
        if (!CMS\Factory::getUser()->authorise('fox5.courtroll.delete', 'com_courtroll')) {
            return false;
        }

        $courtrollTable = new Table\CourtrollTable($this->dbo);
        if ($courtrollTable->delete($id)) {
            $app = CMS\Factory::getApplication();
            $app->enqueueMessage('Courtroll deleted', 'success');
        }

        return true;

    }
}
