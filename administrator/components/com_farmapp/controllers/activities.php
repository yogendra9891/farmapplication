<?php
/**
 * @version     2.5.0
 * @package     com_farmapp
 * @copyright   Copyright (C) 2012. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Created by com_combuilder - http://www.notwebdesign.com
 */

// No direct access.
defined('_JEXEC') or die;


/**
 * Activities list controller class.
 */
class ActivitiesControllerFarmapp extends FarmappController
{
	
	/**
	 * Constructor.
	 *
	 * @param	array	$config	An optional associative array of configuration settings.
	 
	 * @see		JController
	 * @since	1.6
	 */
	public function __construct($config = array())
	{
		
		parent::__construct($config);

	}
	
	
	function display()
	{
	
		$model=$this->getModel('activities');
		$items=$model->getItems();
		$pagination = $model->getPagination();
		$state = $model->getState();
		$view=$this->getView('activities','html');
		$view->assign('items',$items);
		$view->assign('pagination',$pagination);
		$view->assign('state',$state);
		$view->display();
	}
	
	function edit()
	{     // echo "add"; exit;
			$id	= JRequest::getVar('cid','0');
		   	$model=$this->getModel('activity');
			// get the Data
			$item = $model->getItem($id[0]);
			$form = $model->getForm($id[0]); 
	//		var_dump($form); die;
			$view = $this->getView('activity','html');
	//		var_dump($view); die;
			$view->assign('form',$form);
			$view->assign('item',$item);
			$view->setLayout('edit');
			$view->display();
			
	}
	/*
	 * Method for save data from farm-form......
	 * 
	 */
	function save()
	{
				$task	= $this->getTask();
		$data=JRequest::get('post');
		$model=$this->getModel('activity');
		$id=$model->save($data);
		if($id!=='')
		{
			switch ( $task )
			{
				case 'save2new':
					$link = 'index.php?option=com_farmapp&view=activities&task=add';
					$this->setRedirect($link, $msg);
					break;
				case 'save':
					$msg = JText::_( 'Activity save successfully' );
					$link = 'index.php?option=com_farmapp&view=activities';
					$this->setRedirect($link, $msg);
					break;
				case 'apply':
					$msg = JText::_( 'Activity save successfully' );
					$link = 'index.php?option=com_farmapp&view=activities&task=edit&cid[]='.$id;
					$this->setRedirect($link, $msg);
					break;
			}
			
		}
	}
	
	

	/*
	 * Method for deleting single/multiple Activities......
	 * 
	 */
	 function delete()
	{
	  $model = $this->getModel('activities');
	 if(!$model->delete()) {
	 $msg = JText::_( 'Error: One or More Activities Could not be Deleted' );
	 }else{
		        $msg = JText::_( 'Activity(s) Deleted' );
		    }
	 $link = 'index.php?option=com_farmapp&view=activities';
	 $this->setRedirect($link, $msg);
		
	}
	/*
	 * Method for publish single/multiple Activities......
	 * 
	 */
	 function multiplepublish()
	{
	 
	 $model = $this->getModel('activities');
	 if(!$model->multiplepublish()) {
	 $msg = JText::_( 'Error: One or More Activities Could not be published' );
	 } else {
		        $msg = JText::_( 'Activity(s) Published.' );
		    }
	  $link = 'index.php?option=com_farmapp&view=activities'; 
	 $this->setRedirect($link, $msg);
		
	}	
		/*
	 * Method for unpublish single/multiple Activities......
	 * 
	 */
	 function multipleunpublish()
	{
		 $model = $this->getModel('activities');
			 if(!$model->multipleunpublish()){
			 $msg = JText::_( 'Error: One or More Activities Could not be unpublished' );
			 }else{
				        $msg = JText::_( 'Activity(s) UnPublished.' );
				    }
		 $link = 'index.php?option=com_farmapp&view=activities';
		 $this->setRedirect($link, $msg);
	}
	
	/*method single row publish and unpublish on click on tick mark*/
	function publish(){
	

		// Initialise variables.
		
		$ids	= JRequest::getVar('cid', array(), '', 'array');
		$values	= array('publish' => 1, 'unpublish' => 0);
		$task	= $this->getTask(); 
		$value	= JArrayHelper::getValue($values, $task, 0, 'int');

		if (empty($ids)) {
			JError::raiseWarning(500, JText::_('JERROR_NO_ITEMS_SELECTED'));
		}
		else {
			// Get the model.
			$model = $this->getModel('activities');

			// Publish the items.
			if (!$model->publish($ids, $value)) {
				JError::raiseWarning(500, $model->getError());
			}
		}

		$this->setRedirect('index.php?option=com_farmapp&view=activities');
	}
	/*
	 * 
	 * Method to get the zones according to the farm........
	 */
	
	function findzones()
	{ 
	    $model=$this->getModel('activities');
		$farmid = JRequest::getVar('val'); 
		$activityid = JRequest::getVar('activityid'); 
		$zonelist = $model->getzonelist($farmid, $activityid);	
        echo $zonelist; 
	}	
	/*
	 * 
	 * Method to get the beds according to the farm and zones........
	 */
	
	function findbeds()
	{ 
	    $model=$this->getModel('activities');
		$farmid = JRequest::getVar('val'); 
		$activityid = JRequest::getVar('activityid'); 
		$zoneid = JRequest::getVar('zoneid'); 
		$bedlist = $model->getbedslist($farmid, $activityid, $zoneid);	
        echo $bedlist; 
	}	
	
	/*
	 * 
	 * Method to get the beds according to the farm and zones........
	 */
	
	function findcrops()
	{ 
	    $model=$this->getModel('activities');
		$farmid = JRequest::getVar('val'); 
		$activityid = JRequest::getVar('activityid'); 
		$zoneid = JRequest::getVar('zoneid'); 
		$bedid = JRequest::getVar('bedid');
		$croplist = $model->getcropslist($farmid, $activityid, $zoneid, $bedid);	
        echo $croplist; 
	}	
	
}