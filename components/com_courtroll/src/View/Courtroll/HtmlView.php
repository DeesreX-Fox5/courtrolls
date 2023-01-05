<?php
namespace Fox5\Component\Courtroll\Site\View\Courtroll;

defined('_JEXEC') or die('Restricted access');

use Fox5\Component\Courtroll\Site\Model\CourtrollModel;
use Joomla\CMS\Factory;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;

/**
 * HTML View for the Courtroll Component
 *
 * @package     Fox5\Component\Courtroll\Site\View\Courtroll
 *
 * @since       version 4.2.4
 */
class HtmlView extends BaseHtmlView
{
	/**
	 * Displays the template
	 *
	 * @param $tpl
	 *
	 * @throws \Exception
	 * @since version 4.2.4
	 */

	public function display($tpl = null)
	{
		$this->model = new CourtrollModel();
		$this->rolls = $this->model->loadFileCategory();
		
		return parent::display($tpl);
	}

	/**
	 * Gets the form
	 *
	 * @return false|\Joomla\CMS\Form\Form|mixed
	 *
	 * @throws \Exception
	 * @since version 4.2.4
	 */
	public function getForm() {
		return $this->model->getForm();
	}

	/**
	 * Gets the judge
	 *
	 * @param $id
	 *
	 * @return array
	 *
	 * @since version 4.2.4
	 */
	protected function getJudge($id){
		$dbo = Factory::getDbo();
		$query = $dbo->getQuery(true);
		$query->select('judge')
			->from($dbo->quoteName('#__roll_judge'))
			->where($dbo->quoteName('roll_id') . ' = ' . $dbo->quote($id));
		$dbo->setQuery($query);
		$result = $dbo->loadRowList();

//		to array
		$judges = array();
		foreach ($result as $judge){
			$judges[] = $judge[0];
		}
		return $judges;
	}

	protected function getPermission(){
		$user = Factory::getUser();
		return $user->authorise('core.delete', 'com_courtroll');
	}
}
