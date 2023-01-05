<?php
namespace Fox5\Component\Courtroll\Site\Controller;

defined('_JEXEC') or die;

use \Joomla\CMS\MVC\Controller\BaseController;

class DisplayController extends BaseController
{
	/**
	 * Displays the view
	 *
	 * @param $cachable
	 * @param $urlparams
	 *
	 * @return DisplayController
	 *
	 * @throws \Exception
	 * @since version 4.2.4
	 */
	public function display($cachable = false, $urlparams = array())
	{
		return parent::display($cachable, $urlparams);
	}
}
