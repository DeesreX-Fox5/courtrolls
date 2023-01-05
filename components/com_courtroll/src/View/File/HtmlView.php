<?php
namespace Fox5\Component\Courtroll\Site\View\File;

use Fox5\Component\Courtroll\Site\Model\FileModel;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;

defined('_JEXEC') or die('Restricted access');


/**
 * Displays the file upload form
 *
 * @package     Fox5\Component\Courtroll\Site\View\File
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
	 *
	 * @throws \Exception
	 * @since version 4.2.4
	 */
	public function display($tpl = null)
	{
		$this->model = new FileModel();
		return parent::display($tpl);
	}


}
