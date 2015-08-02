<?php
/**
 * @version     1.0.0
 * @package     com_farmapp
 * @copyright   Copyright (C) 2012. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Created by com_combuilder - http://www.notwebdesign.com
 */

defined('_JEXEC') or die;


JLoader::import( 'com_farmapp.models.farmapp', JPATH_ADMINISTRATOR.DS.'components' );
JLoader::import( 'com_farmapp.helpers.farmapp', JPATH_ADMINISTRATOR.DS.'components' );
JLoader::import( 'com_farmapp.models.fields.beds', JPATH_ADMINISTRATOR.DS.'components' );
JFormHelper::loadFieldClass('list');
/**
 * Methods supporting a list of farms records.
 */
class CropsModelCrops extends FarmAppModelFarmApp
{

    /**
     * Constructor.
     *
     * @param    array    An optional associative array of configuration settings.
     * @see        JController
     * @since    1.6
     */
    public function __construct($config = array())
    {  
    	
        parent::__construct($config);
     }

	
	
	/**
	 * Build an SQL query to load the list data.
	 *
	 * @return	JDatabaseQuery
	 * @since	1.6
	 */
	public function _getListQuery()
	{
		
		// Filter
		  $search = $this->getState('filter.search');
		
		// Create a new query object.		
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		// Select some fields
		$query->select('id,name,status,description,CONCAT_WS(",", zone_id, bed_id) as location');
		// From the hello table
		$query->from('#__crop as a');
		$query->order($db->getEscaped($this->getState('list.ordering')).' '.$db->getEscaped($this->getState('list.direction')));
		if (!empty($search)) {
			$query->where('(a.name LIKE '.$db->Quote('%'.$db->getEscaped($search, true).'%').')');
		}
		
		
		return $query;
	}
	
	
/*
	 * function is for doing the publish/unpublish the farm in default.php of farms templates..
	 * 
	 */
	public function publish($pks = null, $state = 1, $userId = 0)
	{ 
		// Sanitize input.
		JArrayHelper::toInteger($pks);
		$userId = (int) $userId;
		$state  = (int) $state;
		$id = $pks[0];
		// If there are no primary keys set check to see if the instance key is set.
		if (empty($pks))
		{
			if ($this->$k) {
				$pks = array($this->$k);
			}
			// Nothing to set publishing state on, return false.
			else {
				$this->setError(JText::_('JLIB_DATABASE_ERROR_NO_ROWS_SELECTED'));
				return false;
			}
		}

		// Build the WHERE clause for the primary keys.
		$where = $k.'='.implode(' OR '.$k.'=', $pks);


		// Update the publishing state for rows with the given primary keys.
		$this->_db->setQuery(
			'UPDATE #__crop' .
			' SET '.$this->_db->quoteName('status').' = '.(int) $state .
			' WHERE (id) =' . $id
			 );
		$this->_db->query();

		// Check for a database error.
		if ($this->_db->getErrorNum()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
   // this below line for the seeting the current status may be (status is the for publish/unpublish field..)
        $this->status = $state;
		$this->setError('');
		return true;
	}

/**
	 * Method to delete record(s)
	 *
	 * @access    public
	 * @return    boolean    True on success
	 */
		function delete()
		{
		    $cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
		    $row =& $this->getTable('Crop','CropTable');
		  //  var_dump($cids); die;
		    foreach($cids as $cid) {
		  		if (!$row->delete( $cid )) {
		  			 $this->setError( $row->getErrorMsg() );
		            return false;
		        }
		    }
		 
		    return true;
		}
/**
	 * Method to publish record(s)
	 *
	 * @access    public
	 * @return    boolean    True on success
	 */
		function multiplepublish()
		{
		    $cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
		    $db =& JFactory::getDBO();
		    
		    foreach($cids as $cid) {
			 	$query = 'UPDATE #__crop SET status = 1'.
                		 '  WHERE id = '.$cid;  
                $db->setQuery($query);
                $db->query();
		     }
			 return true;
		}

		/**
	 * Method to unpublish record(s)
	 *
	 * @access    public
	 * @return    boolean    True on success
	 */
		function multipleunpublish()
		{
		    $cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
		    $db =& JFactory::getDBO();
		    
		    foreach($cids as $cid) {
				$query = 'UPDATE #__crop SET status = 0'.
                		 '  WHERE id = '.$cid; 
                $db->setQuery($query);
                $db->query();
		     }
			 return true;
		}	
	/*
	 * 
	 * Method for getting the beds list by the ajax call from a editing a crop..
	 */
	function getbedslist($ids)
	{
	   $idarray = explode('/',$ids);
	   $farmid = (int)$idarray[0];
	   $zoneid = (int)$idarray[1];
	   $options = array();

		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);

		$query->select('a.id , a.name ');
		$query->from('#__bed AS a');
		$query->where('a.farm ='.$farmid .' AND a.zone = '.$zoneid);
		$query->order('a.name');
	//	echo $query; exit;
      	// Get the options.
		$db->setQuery($query);

        $options = $db->loadObjectList();
		echo '<label title="" class="hasTip required" for="bed_id" id="bed_id-lbl">Beds<span class="star">&nbsp;*</span></label>';
        echo '<select id="bed_id" name="bed_id">';
        echo '<option value="0">-- Select Bed--</option>';
        for ($i=0, $n=count( $options ); $i < $n; $i++) 
        {
            $row = &$options[$i];
            echo '<option value="'. $row->id.'">'.$row->name.'</option>';
        }
        echo '</select>';
       return;	       
					   
	}

	
}