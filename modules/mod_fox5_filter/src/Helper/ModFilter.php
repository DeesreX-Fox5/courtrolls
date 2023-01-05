<?php

namespace Fox5\Module\Filter\Site\Helper;

class ModFilter
{
	public static function getForm(){
		$model = new \Fox5\Component\Courtroll\Site\Model\CourtrollModel();
		$input = new \Joomla\Input\Input();
		$data = $input->get('filteredData', array(), 'array');
		$input->filteredData = $data;
		$form = $model->getForm();
		$form->bind($data);
		return $form;
	}

	public static function getViewType(){
		$input = new \Joomla\Input\Input();
		return $input->get('view', 'courtroll', 'string');
	}
}
