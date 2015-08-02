<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
 
// import Joomla table library
jimport('joomla.database.table');
 
/**
 * Farm Table class
 */
class FarmappTableFarm extends JTable
{
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
        

        return parent::bind($array, $ignore);
    }
	
}