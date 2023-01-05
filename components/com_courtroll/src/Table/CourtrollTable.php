<?php

namespace Fox5\Component\Courtroll\Site\Table;

use Joomla\CMS\Factory;
use Joomla\Input\Input;

/**
 * Table holding all Courtroll data
 *
 * @package     Fox5\Component\Courtroll\Site\Table
 *
 * @since       version 4.2.4
 */
class CourtrollTable extends \Joomla\CMS\Table\Table
{
	/**
	 * Joomla Input object
	 *
	 * @var Input
	 * @since version 4.2.4
	 */
	protected Input $input;

	/**
	 * Constructor
	 *
	 * @param $db
	 *
	 * @since version 4.2.4
	 */
	public function __construct(&$db)
	{
		$this->input = new Input();
		parent::__construct('#__roll', 'id', $db);
	}

	/**
	 * Loads the roll data with filters
	 *
	 * @param $filters
	 *
	 * @return array|mixed
	 *
	 * @since version 4.2.4
	 */
	public function loadRoll($filters)
	{
        $input = new Input();
		$query = $this->_db->getQuery(true);
		$query->select('#__roll.*');
		$query->from('#__roll');
		$query->join('LEFT', $this->_db->quoteName('#__roll_judge')
			. ' ON ' . $this->_db->quoteName('#__roll.id') . ' = '
			. $this->_db->quoteName('#__roll_judge.roll_id'));


        if(!empty($filters['category'])){
            $query->where('category = ' . $this->_db->quote($input->get('category', 'courtrolls', 'string')));
        }

//        die($query->__toString());

		if (!empty($filters["roll"]))
		{
			$query->where('roll = ' . $this->_db->quote($filters["roll"]));
		}
		if (!empty($filters["judge"]))
		{
			$query->where('#__roll_judge.judge LIKE ' . $this->_db->quote("%" . $filters["judge"] . "%"));
		}
		if (!empty($filters["date"]) && !empty($filters["date_valid_until"]))
		{
			$query->where('date >= ' . $this->_db->quote($filters["date"]) .
				' AND date_valid_until <= ' . $this->_db->quote($filters["date_valid_until"]));
		}
		if (!empty($filters["date"]) && empty($filters["date_valid_until"]))
		{
			$query->where('date >= ' . $this->_db->quote($filters["date"]) .
				' AND date_valid_until <= ' . $this->_db->quote($filters["date"]));
		}
		if (!empty($filters["description"]))
		{
			$query->where('description LIKE ' . $this->_db->quote("%" . $filters["description"] . "%"));
		}

		$this->_db->setQuery($query);
		return $this->_db->loadObjectList();
	}

	/**
	 * Gets a list of all judges
	 *
	 * @return array
	 *
	 * @since version 4.2.4
	 */
	public function getJudgeList()
	{
		$query = $this->_db->getQuery(true);
		$query->select('judge');
		$query->from('#__roll_judge');
		$query->group('judge');
		$this->_db->setQuery($query);
		return $this->_db->loadRowList();
	}

	/**
	 * Gets all active rolls
	 *
	 * @param $roll
	 *
	 * @return array|mixed
	 *
	 * @since version 4.2.4
	 */
	public function getActiveRolls($roll)
	{
		$date = $this->_db->quote(date("Y-m-d"));
		$query = $this->_db->getQuery(true);
		$query->select('#__roll.*');
		$query->from('#__roll');
		$query->join('LEFT', $this->_db->quoteName('#__roll_judge')
			. ' ON ' . $this->_db->quoteName('#__roll.id') . ' = '
			. $this->_db->quoteName('#__roll_judge.roll_id'));
		$query->where('roll = ' . $this->_db->quote($roll));
		$query->where('date >= ' . $date .
			' AND date_valid_until <= ' . $date);
		$this->_db->setQuery($query);
		return $this->_db->loadObjectList();
	}
}
