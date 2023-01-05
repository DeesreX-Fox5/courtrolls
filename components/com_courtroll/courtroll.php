<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_client
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
jimport('fox5.helper.controller.controller');

// Application
$app = JFactory::getApplication();

// Load classes
JLoader::registerPrefix('Fox5', JPATH_LIBRARIES . '/fox5');
JLoader::registerPrefix('Courtroll', JPATH_COMPONENT);

// Tell the browser not to cache this page.
$app->setHeader('Expires', 'Mon, 26 Jul 1997 05:00:00 GMT', true);

$location = 'Courtroll';

$controllerHelper = new Fox5ControllerHelper($location);

$controller = $controllerHelper->parseController();


$controller->prefix = $location;
$controller->tablePrefix = $location.'Table';
$controller->execute();
