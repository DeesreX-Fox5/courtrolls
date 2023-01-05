<?php

namespace Fox5\Module\Filter\Site\Helper;

defined('_JEXEC') or die;

use JModuleHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Layout\LayoutHelper;
use JUri;

$document = Factory::getDocument();
$document->addScript( 'modules/mod_fox5_filter/media/filterCalendar.js');

$form   = ModFilter::getForm();
$layout = $params->get('layout', 'default');

require_once JModuleHelper::getLayoutPath('mod_fox5_filter');


