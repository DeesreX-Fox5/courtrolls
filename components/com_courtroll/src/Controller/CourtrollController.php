<?php
/**
 * @package     Fox5\Component\Courtroll\Site\Controller
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace Fox5\Component\Courtroll\Site\Controller;

use Joomla\CMS\MVC\Controller\BaseController;

class CourtrollController extends BaseController
{
	public function execute($task)
	{
		if($task == 'delete'){
			$model = new \Fox5\Component\Courtroll\Site\Model\CourtrollModel();
			$id = $this->input->get('id');
//			TODO: ask user to confirm delete using a modal

			if($model->delete($id)){
				$this->app->redirect('index.php/courtrolls-test?view=courtroll&layout=rolls');
			}
		}
	}
}
