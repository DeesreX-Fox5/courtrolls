<?php

namespace Fox5\Module\ActiveRolls\Site\Helper;

class ModActiveRolls
{
	public static function getActiveRolls($roll){
		$model = new \Fox5\Component\Courtroll\Site\Model\CourtrollModel();
		$activeRolls = $model->getActiveRolls($roll);
		return $activeRolls;
	}
}
