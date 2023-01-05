<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace Fox5\Component\Courtroll\Site\Table;

/**
 * Table holding all Judges
 *
 * @package     Fox5\Component\Courtroll\Site\Table
 *
 * @since       version
 */
class JudgeTable extends \Joomla\CMS\Table\Table
{
	/**
	 * Constructor
	 *
	 * @param $db
	 *
	 * @since version 4.2.4
	 */
	public function __construct($db)
	{
		parent::__construct('#__roll_judge', 'id', $db);
	}

	/**
	 * Gets the judge from id
	 *
	 * @param $id
	 *
	 * @return mixed|void
	 *
	 * @since version 4.2.4
	 */
	public function getJudge($id)
	{
		$query = $this->_db->getQuery(true);
		$query->select('judge')
			->from($this->_db->quoteName('#__roll_judge'))
			->where($this->_db->quoteName('roll_id') . ' = ' . $this->_db->quote($id));
		$this->_db->setQuery($query);
		$result = $this->_db->loadColumn();
		if($result)
		{
			return $result[0];
		}
	}
}
