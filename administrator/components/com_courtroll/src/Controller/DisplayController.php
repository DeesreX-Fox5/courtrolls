<?php

namespace Fox5\Component\Courtroll\Administrator\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\BaseController;

class DisplayController extends BaseController {


	/**
	 * @var string The default view for the display method.
	 * @since version 4.2.4
	 */
	protected $default_view = 'courtroll';

	/**
	 * Displays a view
	 *
	 * @param $cachable
	 * @param $urlparams
	 *
	 * @return DisplayController
	 *
	 * @throws \Exception
	 * @since version 4.2.4
	 */
	public function display($cachable = false, $urlparams = array()) {
        return parent::display($cachable, $urlparams);
    }

}
