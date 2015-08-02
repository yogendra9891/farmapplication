<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
 
// import Joomla table library
jimport('joomla.database.table');


/**
 * Farm Table class
 */
class PlantvarietyTablePlantvariety extends JTable
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
	var $name = null;
	var $description = null;
	var $notes = null;
	var $status = null;
	var $options = null;
	var $language = null;
		
	
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function __construct(&$db) 
	{
		parent::__construct('#__plant_variety', 'id', $db);
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