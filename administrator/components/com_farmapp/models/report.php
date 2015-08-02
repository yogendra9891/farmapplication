<?php
/**
 * @version     1.0.0
 * @package     com_farmapp
 * @copyright   Copyright (C) 2012. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Created by com_combuilder - http://www.notwebdesign.com
 */

defined('_JEXEC') or die;


jimport('joomla.application.component.modeladmin');
/**
 * Methods supporting a list of farms records.
 */
class ReportModelReport extends JModelAdmin
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
		
		// Create a new query object.		
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		// Select some fields
		$query->select('a.id,a.name,a.description,b.name as farm,a.status');
		// From the hello table
		$query->from('#__photos as a');
		$query->innerJoin('#__farm as b ON a.farm=b.id');
		$query->order($db->getEscaped($this->getState('list.ordering')).' '.$db->getEscaped($this->getState('list.direction')));
		if (!empty($search)) {
			$query->where('(a.name LIKE '.$db->quote('%'.$search.'%').')');
		}
		if (is_numeric($farmid)) {
			$query->where('a.farm = '.(int) $farmid);
		}
		
		return $query;
	}
	
	
/**
	 * Method to get the record form.
	 *
	 * @param	array	$data		Data for the form.
	 * @param	boolean	$loadData	True if the form is to load its own data (default case), false if not.
	 * @return	mixed	A JForm object on success, false on failure
	 * @since	1.6
	 */
	public function getForm($data = array(), $loadData = true) 
	{
		
		// Get the form.
		$form = $this->loadForm('com_farmapp.actreport','actreport', array('load_data' => $loadData));
	
		if (empty($form)) 
		{
			return false;
		}
	
		
		return $form;
	}
	
/**
	 * Method to get the record form.
	 *
	 * @param	array	$data		Data for the form.
	 * @param	boolean	$loadData	True if the form is to load its own data (default case), false if not.
	 * @return	mixed	A JForm object on success, false on failure
	 * @since	1.6
	 */
	public function getFinForm($data = array(), $loadData = true) 
	{
		
		// Get the form.
		$form = $this->loadForm('com_farmapp.finreport','finreport', array('load_data' => $loadData));
	
		if (empty($form)) 
		{
			return false;
		}
	
		
		return $form;
	}
	
/*
 * 
 * Method to get th zones according to farms...... 
 */
 public function getzonesfromfarm($farmid)
 {
   	    $farmid = $farmid;
	    $options = array();

		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);

		$query->select('z.id , z.name ');
		$query->from('#__zone AS z');
		$query->join('INNER','#__farm AS f ON z.farm = f.id');
		$query->where('z.farm = '.$farmid );
		$query->order('z.name');
     	// Get the options.
     	$db->setQuery($query);
        $options = $db->loadObjectList();
		echo '<label title="Zones" class="hasTip required" for="zone" id="zone-lbl">Zones</label>';
        echo '<select id="zone" class="zoneselect" name="zone" >';
        echo '<option value="0">-- Select Zone--</option>';
        for ($i=0, $n=count( $options ); $i < $n; $i++) 
        {
             $row = &$options[$i];
     //        $selected	= (in_array($row->id, $expval)) ? ' selected="selected"' : '';
             echo '<option value="'. $row->id.'"'.$selected.'>'. $row->name.'</option>';
        }
       echo '</select>';
       return;	       
 	
 }

 /*
 * 
 * Method to get the beds according to zones and farms...... 
 */
 public function getbedsfromfarmzone($farmid, $zoneid)
 {
   	    $farmid = $farmid;
   	    $zoneid = $zoneid;
	    $options = array();

		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);

//		$query->select('s.id, s.name ');
//		$query->from('select b1.name as name, b1.id as id, b1.farm as farm_id from farm_bed as b1 INNER JOIN farm_zone as z ON b1.zone  = z.id where b1.zone = '.$zoneid);
//		$query->join('INNER',$db->quoteName('#__zone').' AS z ON b.farm = z.farm');
//		$query->join('INNER',$db->quoteName('#__farm').' AS f ON b.farm = f.id');
//		
//		$query->where('b.farm = '.$farmid. ' AND b.zone = ' .$zoneid);
//		$query->order('b.name');
     	// Get the options.
     	$query = "select s.id, s.name from(select b1.name as name, b1.id as id, b1.farm as farm_id from farm_bed as b1 INNER JOIN farm_zone as z ON b1.zone  = z.id where b1.zone = ".$zoneid.")".
     	 "as s INNER JOIN farm_farm as f ON f.id = s.farm_id where f.id = ".$farmid;
		$db->setQuery($query);
        $options = $db->loadObjectList();
		echo '<label title="Beds" class="hasTip required" for="bed" id="zone-lbl">Beds</label>';
        echo '<select id="bed" class="bedsselect" name="bed" >';
        echo '<option value="0">-- Select Bed--</option>';
        for ($i=0, $n=count( $options ); $i < $n; $i++) 
        {
             $row = &$options[$i];
     //        $selected	= (in_array($row->id, $expval)) ? ' selected="selected"' : '';
             echo '<option value="'. $row->id.'"'.$selected.'>'. $row->name.'</option>';
        }
       echo '</select>';
       return;	       
 	
 }
 /*
  * Method to getting the Activity report accroding to the data(date,crop,zone,farmn and bed).... 
  * 
  */
 
 public function getactivitiesreoprt($data)
 {     // echo "kkk"; exit;
   		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);
		$startdate = $data[0];
		$enddate = $data[1];
		$cropid = $data[2];
		$farmid = $data[3];
		$zoneid = $data[4];
		$bedid  =  $data[5];
		
		$query = "select ss.activityid, ss.activityname, l.name as Laborcategory, ss.description, ss.status, ss.zonebeds from(".
		         "select s.zonebed as zonebeds, a.id as activityid , a.name as activityname, a.description as description, a.activity_status as".
		         " status, a.labor_category_id as labor_category_id from(".
				 "select".  " CONCAT_WS('/', z.name , b.name)". "as zonebed,  b.id as bedid, z.id as zoneid from farm_zone as z INNER JOIN farm_bed as b  ON z.id" . 
				 "= b.zone";
		 if(($zoneid != 0 && $zoneid != NULL) || ($bedid != 0 && $bedid != NULL))
		 {
		 	$query .= " Where ";
		 }
		 if($zoneid != 0 && $zoneid != NULL)
		 {
		   $query .= " z.id = ".$zoneid ;
		 }
		 if(($zoneid != 0 && $zoneid != NULL) && ($bedid != 0 && $bedid != NULL))
		 {
		 	$query .= " AND ";
		 }
		 
		 if($bedid != 0 && $bedid != NULL)
		 {
		   $query .= " b.id = ".$bedid;
		 }
		 
		 $query .= ") as s";
		 $query .= " INNER JOIN farm_activity as a ON s.bedid = a. bed where a.crop = ". $cropid ." and a.farm = ". $farmid ;
		 if($startdate != NULL && $startdate != '')
		 {
		  $query .= " AND a.date_of_activity >= ".$db->quote(DATE($startdate));
		 }
		 if($enddate != NULL && $enddate != '')
		 {
		  $query .= " AND a.date_of_activity <= ".$db->quote(DATE($enddate));
		 }
		 
		 $query .= " )as ss";
		 $query .= " INNER JOIN farm_labor_category as l ON ss.labor_category_id = l.id";
	//	 $query .= "Orderby" .$this->getState('list.ordering'). ' ' .$this->getState('list.direction');
	//	 $query .= $db->getEscaped($this->getState('list.ordering')).' '.$db->getEscaped($this->getState('list.direction'));
	//	 $query->order($db->getEscaped($this->getState('list.ordering')).' '.$db->getEscaped($this->getState('list.direction')));
		 $db->setQuery($query); 
		 $options = $db->loadObjectList();
	//	 var_dump($options); die;
         return $options;
 }
 
 /*
  * Method to getting the profit/Loss report accroding to the data(date,crop,zone,farmn and bed).... 
  * 
  */
 
 public function getprofitlossreoprt($data)
 {     // echo "kkk"; exit;
   		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);
		$startdate = $data[0];
		$enddate = $data[1];
		$cropid = $data[2];
		$farmid = $data[3];
		$zoneid = $data[4];
		$bedid  =  $data[5];
		
		$query = "select a.id, a.name, a.duration, a.quantity, a.labor_category_id, a.cost, a.material_cost from #__activity as a";
		$query .= " where a.farm = ".$farmid." AND a.crop = ".$cropid;
		 if(($zoneid != 0 && $zoneid != NULL))
		 {
		 	$query .= " AND a.zone = ".$zoneid ;
		 }
		 if($bedid != 0 && $bedid != NULL)
		 {
		   $query .= " AND a.bed = ".$bedid;
		 }
		 
        if($startdate != NULL && $startdate != '')
		 {
		  $query .= " AND a.date_of_activity >= ".$db->quote(DATE($startdate));
		 }
		 if($enddate != NULL && $enddate != '')
		 {
		  $query .= " AND a.date_of_activity <= ".$db->quote(DATE($enddate));
		 }
		 $db->setQuery($query); 
		 $options = $db->loadAssocList();
		 $laborexpense = 0;
		 $materialexpense = 0;
		 foreach($options as $option)
		 {  
		 	$laborid = (int)$option['labor_category_id'];
		 	$person = $this->countperson($laborid, $farmid);
		    $laborexpense += $person * ((int)$option['cost']) * ((int)$option['duration']);
		    $materialexpense += ((int)$option['quantity'])*((int)$option['material_cost']);
		   
		 }
		 /*
		  * finding the total income from the crop according to the cropid..........
		  */
		 $cropincome = $this->findcropincome($cropid);
		 $total = 0;
		 $total = $cropincome - ($laborexpense + $materialexpense);
		 $data = array($cropincome, $laborexpense, $materialexpense, $total); 
         return $data;
 }
 
 /*
  * Method for counting the no. of person according to the labor categoyid.......
  * 
  */
  private function countperson($laborid, $farmid)
  {
       	$db		= JFactory::getDbo();
		$query1	= $db->getQuery(true);
		$query1 = "select count(e.id) from #__employees as e where e.labor_category= ".$laborid ." AND e.farm = ".$farmid; 
		$db->setQuery($query1); 
		$persons = $db->loadResult(); //var_dump($persons);
		return $persons;
  	
  }
  /*
   * Method to get the crop total income according to the cropid...
   * 
   */
  private function findcropincome($cropid)
  {
       	$db		= JFactory::getDbo();
		$query2	= $db->getQuery(true);
		$query2 = "select c.total_income from #__crop as c where c.id= ".$cropid; 
		$db->setQuery($query2);
		$result = $db->loadResult(); 
		return $result;
  	
  }
}