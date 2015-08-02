<?php
/**
 * @version     1.0.0
 * @package     com_farmapp
 * @copyright   Copyright (C) 2012. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Created by com_combuilder - http://www.notwebdesign.com
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');
JLoader::import( 'com_farmapp.views._base', JPATH_ADMINISTRATOR.DS.'components' );

/**
 * View class for a list of Gnadmin.
 */
class ReportViewReport extends FarmViewBase
{

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{	
	    $layout = $this->getLayout();
   	    parent::display($tpl);
	}
	
	/**
	 * Setting the toolbar
	 */
	public function addToolBar() 
	{   //echo "test1"; exit;
		$layout = $this->getLayout();
		$current = strtolower( JRequest::getCmd('view') );
		$current_view = ucfirst($current);
//		require_once JPATH_COMPONENT.DS.'helpers'.DS.'farmapp.php';
//		$isNew		= (@$this->items->id == 0);
//		$canDo		= FarmappHelper::getActions();
		
		switch(strtolower($layout))
		{
			 case "activityreport":
			 	if($current != '')
		    	JToolBarHelper::title(JText::_('COM_FARM_MANAGER_FARM').': Activity Report', 'farmapp.png');
		    	else
		    	JToolBarHelper::title(JText::_('COM_FARM_MANAGER_FARM'), 'farmapp.png');
		    	$this->setSubMenu();
		    	// Options button.
				if (JFactory::getUser()->authorise('core.admin', 'com_farmapp')) {
				JToolBarHelper::preferences('com_farmapp');	
				}
			 	
			 	break; 
			 case "finreport":
			 	if($current != '')
		    	JToolBarHelper::title(JText::_('COM_FARM_MANAGER_FARM').': 	Profit/Loss Report', 'farmapp.png');
		    	else
		    	JToolBarHelper::title(JText::_('COM_FARM_MANAGER_FARM'), 'farmapp.png');
		    	$this->setSubMenu();
		    	// Options button.
				if (JFactory::getUser()->authorise('core.admin', 'com_farmapp')) {
				JToolBarHelper::preferences('com_farmapp');	
				}
			 	
			 	break; 
			 	
			 	Default:
		   	    if($current != '')
		    	JToolBarHelper::title(JText::_('COM_FARM_MANAGER_FARM').': 	'.$current_view, 'farmapp.png');
		    	else
		    	JToolBarHelper::title(JText::_('COM_FARM_MANAGER_FARM'), 'farmapp.png');
		    	$this->setSubMenu();
		    	// Options button.
				if (JFactory::getUser()->authorise('core.admin', 'com_farmapp')) {
				JToolBarHelper::preferences('com_farmapp');	
				}
			    	    	
		 }
	}
	
}