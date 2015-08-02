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
/**
 * Methods supporting a list of farms records.
 */
class ActivitiesModelActivities extends FarmAppModelFarmApp
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
		  $farmid = $this->getState('filter.farm_id');
		  $zoneid = $this->getState('filter.zone_id');
		  $statusid = $this->getState('filter.activity_status');
		//  var_dump($statusid); 
		//  var_dump($zoneid);die;
		// Create a new query object.		
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		// Select some fields
		$query->select('a.id, a.name, a.activity_mode, a.activity_status, a.date_of_activity, CONCAT_WS("/", f.name, z.name, b.name) as location, a.status');
		// From the hello table
		$query->from('#__activity as a');
		$query->join('INNER', $db->quoteName('#__farm').' AS f ON a.farm = f.id');
		$query->join('INNER', $db->quoteName('#__zone').' AS z ON a.zone = z.id');
		$query->join('INNER', $db->quoteName('#__bed').' AS b ON a.bed = b.id');
		$query->order($db->getEscaped($this->getState('list.ordering')).' '.$db->getEscaped($this->getState('list.direction')));
		if (!empty($search)) {
			$query->where('(a.name LIKE '.$db->Quote('%'.$db->getEscaped($search, true).'%').')');
		}
		if(is_numeric($farmid) && $farmid!=0) {
			$query->where('a.farm = '.(int) $farmid);
		}
		if(is_numeric($zoneid) && $zoneid!=0) {
			$query->where('a.zone = '.(int) $zoneid);
		}
		if($statusid && $statusid!=0) {
			if($statusid == 1)
			{
				$statusid = 'open';
			}
			if($statusid == 2)
			{
				$statusid = 'closed';
			}
			$query->where('a.activity_status = "'. $statusid.'"');
		}
		//var_dump($query); 
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
			'UPDATE #__activity' .
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
		    $row =& $this->getTable('Activity','ActivityTable');
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
			 	$query = 'UPDATE #__activity SET status = 1'.
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
				$query = 'UPDATE #__activity SET status = 0'.
                		 '  WHERE id = '.$cid; 
                $db->setQuery($query);
                $db->query();
		     }
			 return true;
		}	
	
	/*
	 * 
	 * Method for getting the beds list by the ajax call from a editing a activity..
	 */
	function getzonelist($ids, $activityid)
	{
	    $farmid = (int)$ids;
	    $activityid = (int)$activityid;
	    $options = array();

		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);

		$query->select('z.id , z.name ');
		$query->from('#__zone AS z');
		$query->where('z.farm = '.$farmid );
		$query->order('z.name');
     	// Get the options.
		$db->setQuery($query);
        $options = $db->loadObjectList();
        // Get the zones according to farmid,activity...........
   //     echo $query;
 //       var_dump($options);
		$query1	= $db->getQuery(true);
		$query1->select('a.zone');
		$query1->from('#__activity AS a');
		$query1->where('a.farm = '.$farmid .'  AND a.id = '.$activityid);
     	$db->setQuery($query1);
		$zones = array();
        $zones = $db->loadResult();
        $expval= explode(',',$zones);
        //here we are making the autoselected to the beds according to the save in db. and showing the beds non selected which is according to the farmid and zoneid.....
		echo '<label title="" class="hasTip required" for="zone" id="zone-lbl">Zones<span class="star">&nbsp;*</span></label>';
        echo '<select id="zone" class="zoneselect" name="zone" >';
        echo '<option value="0">-- Select Zone--</option>';
        for ($i=0, $n=count( $options ); $i < $n; $i++) 
        {
             $row = &$options[$i];
             $selected	= (in_array($row->id, $expval)) ? ' selected="selected"' : '';
             echo '<option value="'. $row->id.'"'.$selected.'>'. $row->name.'</option>';
        }
       echo '</select>';
       return;	       
					   
	}

	/*
	 * 
	 * Method for getting the beds list by the ajax call from a editing a activity..
	 */
	function getbedslist($ids, $activityid, $zoneid)
	{
	    $farmid = (int)$ids;
	    $activityid = (int)$activityid;
	    $zoneid = (int)$zoneid;
	    $options = array();

		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);

		$query->select('b.id , b.name ');
		$query->from('#__bed AS b');
		$query->where('b.farm = '.$farmid .' AND b.zone = '.$zoneid);
		$query->order('b.name');
     	// Get the options.
		$db->setQuery($query);
        $options = $db->loadObjectList();
        // Get the zones according to farmid,activity...........
  //      echo $query;
 //       var_dump($options);
		$query1	= $db->getQuery(true);
		$query1->select('a.bed');
		$query1->from('#__activity AS a');
		$query1->where('a.farm = '.$farmid .'  AND a.zone = '.$zoneid.'  AND a.id = '.$activityid);
     	$db->setQuery($query1);
		$zones = array();
        $zones = $db->loadResult();
        $expval= explode(',',$zones);
        //here we are making the autoselected to the beds according to the save in db. and showing the beds non selected which is according to the farmid and zoneid.....
		echo '<label title="" class="hasTip required" for="bed" id="bed-lbl">Beds<span class="star">&nbsp;*</span></label>';
        echo '<select id="bed" class="bedselect" name="bed" >';
        echo '<option value="0">-- Select Bed--</option>';
        for ($i=0, $n=count( $options ); $i < $n; $i++) 
        {
             $row = &$options[$i];
             $selected	= (in_array($row->id, $expval)) ? ' selected="selected"' : '';
             echo '<option value="'. $row->id.'"'.$selected.'>'. $row->name.'</option>';
        }
       echo '</select>';
       return;	       
					   
	}
	
	/*
	 * 
	 * Method for getting the crops list by the ajax call from a editing a crop..
	 */
	function getcropslist($ids, $activityid, $zoneid, $bedid)
	{
	    $farmid = (int)$ids;
	    $activityid = (int)$activityid;
	    $zoneid = (int)$zoneid;
	    $bedid = (int)$bedid;
	    $options = array();

		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);

		$query->select('c.id , c.name ');
		$query->from('#__crop AS c');
		$query->where('c.farm = '.$farmid .' AND c.zone_id  = '.$zoneid .' AND c.bed_id = '.$bedid);
		$query->order('c.name');
     	// Get the options.
		$db->setQuery($query);
        $options = $db->loadObjectList();
        // Get the crops according to farmid,activity...........
  //      echo $query;
 //       var_dump($options);
		$query1	= $db->getQuery(true);
		$query1->select('a.crop');
		$query1->from('#__activity AS a');
		$query1->where('a.farm = '.$farmid .'  AND a.zone = '.$zoneid.'  AND a.id = '.$activityid.'  AND a.bed = '.$bedid);
     	$db->setQuery($query1);
		$crops = array();
        $crops = $db->loadResult();
        $expval= explode(',',$crops);
        //here we are making the autoselected to the beds according to the save in db. and showing the beds non selected which is according to the farmid and zoneid.....
		echo '<label title="" class="hasTip required" for="crop" id="crop-lbl">Crops<span class="star">&nbsp;*</span></label>';
        echo '<select id="crop" class="cropselect" name="crop" >';
        echo '<option value="0">-- Select Crop--</option>';
        for ($i=0, $n=count( $options ); $i < $n; $i++) 
        {
             $row = &$options[$i];
             $selected	= (in_array($row->id, $expval)) ? ' selected="selected"' : '';
             echo '<option value="'. $row->id.'"'.$selected.'>'. $row->name.'</option>';
        }
       echo '</select>';
       return;	       
					   
	}
	
	
}