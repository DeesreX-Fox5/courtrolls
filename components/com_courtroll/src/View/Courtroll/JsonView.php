<?php

namespace Fox5\Component\Courtroll\Site\View\Courtroll;
defined('_JEXEC') or die('Restricted access');

use Fox5\Component\Courtroll\Site\Model\CourtrollModel;
use Joomla\CMS\Factory;

/**
 * View that renders the courtroll data in JSON format
 *
 * @package     Fox5\Component\Courtroll\Site\View\Courtroll
 *
 * @since       version 4.2.4
 */
class JsonView extends \Joomla\CMS\MVC\View\JsonView
{
	/**
	 * Display the view in JSON format
	 *
	 * @param $tpl
	 *
	 * @since version 4.2.4
	 */
	public function display($tpl = null)
	{
		$this->model = new CourtrollModel();
		$rolls = $this->model->loadFileCategory();
		echo $this->formatForJson($rolls);
	}

	/**
	 * Formats the data for JSON
	 *
	 * @param $courtRolls
	 *
	 * @return false|string
	 *
	 * @since version 4.2.4
	 */
	public function formatForJson($courtRolls)
	{
		$model = new CourtrollModel();
		$jonRolls = array();

		foreach ($courtRolls as $key => $rolls)
		{

			foreach ($rolls as $roll)
			{
				$rollArray = [];

				$judge = $model->getJudge($roll->id);

				$rollArray['id']     = $roll->id;
				$rollArray['allDay'] = true;
				$rollArray['title']  = $roll->roll . ' ' . $roll->description . ' ' . $judge;
				$rollArray['start']  = $roll->date;
				$rollArray['end']    = $roll->date_valid_until;
				$rollArray['url']    = $roll->roll_file;

				switch ($roll->roll)
				{
					case "Day Rolls":
						$rollArray['color']     = '#a7fcc1';
						$rollArray['textColor'] = '#000000';
						break;
					case "Opposed Motion Roll":
						$rollArray['color']     = '#41e8d3';
						$rollArray['textColor'] = '#000000';
						break;
					case "Unopposed Motion Roll":
						$rollArray['color'] = '#5c95f8';
						break;
					case "Urgent Court Rolls":
						$rollArray['color'] = '#8c34e4';
						break;
					case "Interlocutory Applications":
						$rollArray['color'] = '#f8a5c2';
						break;
					case "Judicial Management Meetings":
						$rollArray['color'] = '#f2f271';
						break;
					case "Directives":
						$rollArray['color'] = '#a2ccf8';
						break;
					default:
						$rollArray['color'] = '#f8f8f8';
						break;
				}
				$jonRolls[] = $rollArray;
			}

		}

		return json_encode($jonRolls);
	}
}
