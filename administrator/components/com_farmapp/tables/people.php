<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
 
// import Joomla table library
jimport('joomla.database.table');


/**
 * Farm Table class
 */
class PeopleTablePeople extends JTable
{
	 
	
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function __construct(&$db) 
	{
		parent::__construct('#__employees', 'id', $db);
	}
	
	/**
	 * overloading bind function to save data with params
	 *
	 */
	


}