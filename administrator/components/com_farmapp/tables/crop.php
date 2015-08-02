<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
 
// import Joomla table library
jimport('joomla.database.table');


/**
 * Crop Table class
 */
class CropTableCrop extends JTable
{
	 /**
	 * Primary Key
	 *
	 * @var int
	 */
	var $id = null;
	 /**
	 *
	 * @var string 
	 */
	var $bed_id = null;	
	
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function __construct(&$db) 
	{
		parent::__construct('#__crop', 'id', $db);
	}
	

}