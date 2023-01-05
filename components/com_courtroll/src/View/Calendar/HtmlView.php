<?php
namespace Fox5\Component\Courtroll\Site\View\Calendar;

use Fox5\Component\Courtroll\Site\Model\CalendarModel;
use Fox5\Component\Courtroll\Site\Model\CourtrollModel;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;

defined('_JEXEC') or die('Restricted access');

class HtmlView extends BaseHtmlView
{

	/**
	 * @param $tpl
	 * Displays the template
	 *
	 * @throws \Exception
	 * @since version 4.2.4
	 */
	public function display($tpl = null)
	{
		$this->setLayout('calendar');
		return parent::display($tpl);
	}
}
