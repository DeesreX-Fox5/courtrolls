<?php

namespace Fox5\Component\Courtroll\Site\Controller;

use Fox5\Component\Courtroll\Site\Model\FileModel;

/**
 * @package     Joomla.Site
 * @subpackage  com_config
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Base Display Controller
 *
 * @since  3.2
 */
class UploadController extends \Joomla\CMS\MVC\Controller\BaseController
{
	protected $app;
	public $prefix = 'Courtroll';

	
	public function execute($task)
	{
		$model = new FileModel();
		$model->upload();

		return true;
	}
}
