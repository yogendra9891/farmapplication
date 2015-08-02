<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
 
// import Joomla table library
jimport('joomla.database.table');


/**
 * Activity Table class
 */
class ActivityTableActivity extends JTable
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
		
	
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function __construct(&$db) 
	{
		parent::__construct('#__activity', 'id', $db);
	}
	
	/**
	 * overloading bind function to save data with params
	 *
	 */
	
/**
     * Overloaded bind function
     *
     * @param    array        $hash named array
     * @return    null|string    null is operation was satisfactory, otherwise returns an error
     * @see JTable:bind
     * @since 1.5
     */
    public function bind($array, $ignore = array())
    {
       
     if (isset($array['options']) && is_array($array['options'])) {
            $registry = new JRegistry();
            $registry->loadArray($array['options']);
            $array['options'] = (string)$registry;
        }
        parent:: bind($array, $ignore = array());
    }

}