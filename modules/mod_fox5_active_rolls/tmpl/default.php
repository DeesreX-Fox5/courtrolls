<?php
// No direct access
defined('_JEXEC') or die;

$activeRolls = \Fox5\Module\ActiveRolls\Site\Helper\ModActiveRolls::getActiveRolls($params->get('roll'));

foreach ($activeRolls as $activeRoll) {
	echo "<a href='" . $activeRoll->roll_file . "' target='_blank'>" . $activeRoll->date . " - " . $activeRoll->description . "</a>" . "<br>";
}
