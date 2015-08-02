<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
 
// import Joomla table library
jimport('joomla.database.table');


/**
 * Farm Table class
 */
class FarmTableFarm extends JTable
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
	var $street1 = null;
	var $street2 = null;
	var $city = null;
	var $state = null;
	var $postal_code = null;
	var $country = null;
	var $longitude = null;
	var $latitude = null;
	var $directions = null;
	var $telephone = null;
	var $website_url = null;
	var $email_address = null;
	var $hours_of_operation = null;
	var $description = null;
	var $history = null;
	var $date_founded = null;
	var $status = null;
	var $keywords_tags = null;
	var $social_media_links = null;
	var $language = null;
		
	
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function __construct(&$db) 
	{
		parent::__construct('#__farm', 'id', $db);
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
       
     if (isset($array['social_media_links']) && is_array($array['social_media_links'])) {
            $registry = new JRegistry();
            $registry->loadArray($array['social_media_links']);
            $array['social_media_links'] = (string)$registry;
        }
        if (isset($array['keywords_tags']) && is_array($array['keywords_tags'])) {
            $registry = new JRegistry();
            $registry->loadArray($array['keywords_tags']);
            $array['keywords_tags'] = (string)$registry;
        }
         parent:: bind($array, $ignore = array());
    }

}
