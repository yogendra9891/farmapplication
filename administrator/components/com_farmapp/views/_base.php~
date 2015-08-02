<?php


/** ensure this file is being included by a parent file */
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.view' );

class FarmViewBase extends JView
{
 	
	protected $state;
	/*
	 * Submenu list
	 */
	protected $_subMenu=array('farms'=>'Farms',
							  'zones'=>'Zones',
							  'beds'=>'Beds',
							  'crops'=>'Crops',
							  'activities'=>'Activities',
							  'people'=>'People',
							  'reports'=>'Reports',
							  'photos'=>'Photos',
							  'plantvarieties'=>'PlantVariety',
							  'labors'=>'Labors',	
							);
	
	/**
	 * HelloWorlds view display method
	 * @return void
	 */
	function display($tpl = null) 
	{
		
		// Set the toolbar
		$this->addToolBar();
		// Display the template
		parent::display($tpl);
		// Set the Title
		$this->setDocument();
	}

/**
	 * Setting the toolbar
	 */
	protected function addToolBar() 
	{
		$layout = $this->getLayout();
		$current = strtolower( JRequest::getCmd('view') );
		$current_view = ucfirst($current);
		require_once JPATH_COMPONENT.DS.'helpers'.DS.'farmapp.php';
		$isNew		= (@$this->item->id == 0);
		$canDo		= FarmappHelper::getActions();
		
		switch(strtolower($layout))
		{
			case "edit":
					//JToolBarHelper::title(JText::_('COM_FORM_MANAGER_FORM'));
					JToolBarHelper::title($isNew ? JText::_('COM_FARMAPP_TITLE_NEW').$current_view : JText::_('COM_FARMAPP_TITLE_EDIT').$current_view, 'farmapp.png');
					$this->setSubMenu();
			        JToolBarHelper::apply('apply', 'JTOOLBAR_APPLY');
			        JToolBarHelper::save('save', 'JTOOLBAR_SAVE');
			        JToolBarHelper::custom('save2new', 'save-new.png', 'save-new_f2.png', 'JTOOLBAR_SAVE_AND_NEW', false);					
			        JToolBarHelper::cancel('cancel', 'JTOOLBAR_CANCEL');
					break;
		   Default:
		   	    if($current != '')
		    	JToolBarHelper::title(JText::_('COM_FARM_MANAGER_FARM').': 	'.$current_view, 'generic.png');
		    	else
		    	JToolBarHelper::title(JText::_('COM_FARM_MANAGER_FARM'), 'generic.png');
		    	$this->setSubMenu();
		    	JToolBarHelper::addNew('add','JTOOLBAR_NEW');
		    	JToolBarHelper::editList('edit','JTOOLBAR_EDIT');
		    	JToolBarHelper::trash('delete', 'JTOOLBAR_TRASH');
		    	JToolBarHelper::divider();
			    JToolBarHelper::custom('multiplepublish', 'publish.png', 'publish_f2.png','JTOOLBAR_PUBLISH', true);
			    JToolBarHelper::custom('multipleunpublish', 'unpublish.png', 'unpublish_f2.png', 'JTOOLBAR_UNPUBLISH', true);
		    	JToolBarHelper::divider();
			    JToolBarHelper::preferences('com_farmapp');		    	
		 }
	}

/**
	 * Method to set up the document properties
	 *
	 * @return void
	 */
	protected function setDocument() 
	{
		$title = strtoupper( JRequest::getCmd('view') );
		$document = JFactory::getDocument();
		$document->setTitle($title);
		$document->addScript(JURI::root() . 'administrator/components/com_farmapp/js/function.js');
	}
	
/*
    * set sub menu on view
    * 
    * @param None
    * @return 
    */	
   protected function setSubMenu()
   {		
		foreach($this->_subMenu as $key => $val)
		{
			$current = strtolower( JRequest::getCmd('view', 'farms') );
			$active = ($key == $current );
			JSubMenuHelper::addEntry(JText::_($val), 'index.php?option=com_farmapp&view='.$key, $active );
		}
	}
	

	
}
	
	
