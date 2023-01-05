<?php
namespace Fox5\Module\ActiveRolls;

defined('_JEXEC') or die;

use Fox5\Module\ActiveRolls\Site\Helper\ModActiveRolls;
use JModuleHelper;

defined('_JEXEC') or die;

$modActiveRolls = new ModActiveRolls($params);
require JModuleHelper::getLayoutPath('mod_fox5_active_rolls');
