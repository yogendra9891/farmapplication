<?php
/**
 * @version     1.0.0
 * @package     com_farmapp
 * @copyright   Copyright (C) 2012. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Created by com_combuilder - http://www.notwebdesign.com
 */

// No direct access.
defined('_JEXEC') or die;


/**
 * Items list controller class.
 */
class ZonesControllerFarmapp extends FarmappController
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
	
		$model=$this->getModel('zones');
		$items=$model->getItems();
		$pagination = $model->getPagination();
		$state = $model->getState();
		$view=$this->getView('zones','html');
		$view->assign('items',$items);
		$view->assign('pagination',$pagination);
		$view->assign('state',$state);
		$view->display();
	}
	
	function edit()
	{
			$id	= JRequest::getVar('cid','0');
		   	$model=$this->getModel('zone');
			// get the Data
			$item = $model->getItem($id[0]);
			$form = $model->getForm($id[0]); 
			$view=$this->getView('zone','html');
			$view->assign('form',$form);
			$view->assign('item',$item);
			$view->setLayout('edit');
			$view->display();
			
	}
	/*
	 * Method for save data from zone-form......
	 * 
	 */
	function save()
	{
		$task	= $this->getTask();
		$data=JRequest::get('post');
		$model=$this->getModel('zone');
		$id=$model->save($data);
		if($id!=='')
		{
			switch ( $task )
			{
				case 'save2new':
					$link = 'index.php?option=com_farmapp&view=zones&task=add';
					$this->setRedirect($link, $msg);
					break;
				case 'save':
					$msg = JText::_( 'Zone save successfully' );
					$link = 'index.php?option=com_farmapp&view=zones';
					$this->setRedirect($link, $msg);
					break;
				case 'apply':
					$msg = JText::_( 'Zone save successfully' );
					$link = 'index.php?option=com_farmapp&view=zones&task=edit&cid[]='.$id;
					$this->setRedirect($link, $msg);
					break;
			}
			
		}
	}
	
	

	/*
	 * Method for deleting single/multiple  zones......
	 * 
	 */
	 function delete()
	{
	  $model = $this->getModel('zones');
	 if(!$model->delete()) {
	 $msg = JText::_( 'Error: One or More farms Could not be Deleted' );
	 }else{
		        $msg = JText::_( 'Zone(s) Deleted' );
		    }
	 $link = 'index.php?option=com_farmapp&view=zones';
	 $this->setRedirect($link, $msg);
		
	}
	/*
	 * Method for publish single/multiple zones......
	 * 
	 */
	 function multiplepublish()
	{
	 
	 $model = $this->getModel('zones');
	 if(!$model->multiplepublish()) {
	 $msg = JText::_( 'Error: One or More zones Could not be published' );
	 } else {
		        $msg = JText::_( 'zone(s) Published.' );
		    }
	  $link = 'index.php?option=com_farmapp&view=zones'; 
	 $this->setRedirect($link, $msg);
		
	}	
		/*
	 * Method for unpublish single/multiple zones......
	 * 
	 */
	 function multipleunpublish()
	{
		 $model = $this->getModel('zones');
			 if(!$model->multipleunpublish()){
			 $msg = JText::_( 'Error: One or More farms Could not be unpublished' );
			 }else{
				        $msg = JText::_( 'Zones(s) UnPublished.' );
				    }
		 $link = 'index.php?option=com_farmapp&view=zones';
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
			$model = $this->getModel('zones');

			// Publish the items.
			if (!$model->publish($ids, $value)) {
				JError::raiseWarning(500, $model->getError());
			}
		}

		$this->setRedirect('index.php?option=com_farmapp&view=zones');
	}
	
}