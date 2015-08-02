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

/**
 * HTML View class for the Gnadmin component
 */
class FarmappViewFarm extends JView
{
	protected $state;
	protected $item;
	protected $form;
	protected $data;

	function display($tpl = null)
	{  
		$app		= JFactory::getApplication();
		//below line is commented by yogendra because we have not any parameter,....
	  //	$params		= $app->getParams();
		$this->form		= $this->get('Form');
		$this->state	= $this->get('State');
		$this->item		= $this->get('Item');
		$this->data		= $this->get('Data');
		$this->addToolbar();
        parent::display($tpl);

	}
	
	/**
	 * Add the page title and toolbar.
	 */
	public function addToolbar()
	{
	//	JRequest::setVar('hidemainmenu', true);
     
		$user		= JFactory::getUser();
		$isNew		= ($this->item->id == 0);
		$canDo		= FarmappHelper::getActions();
	    JToolBarHelper::title($isNew ? JText::_('COM_FARMAPP_TITLE_FARM_NEW') : JText::_('COM_FARMAPP_TITLE_FARM_EDIT'), 'farmapp.png');
		// If not checked out, can save the item.
		if (($canDo->get('core.edit')||($canDo->get('core.create'))))
		{

			JToolBarHelper::apply('farm.apply', 'JTOOLBAR_APPLY');
			JToolBarHelper::save('farm.save', 'JTOOLBAR_SAVE');
		}
		if (($canDo->get('core.create'))){
			JToolBarHelper::custom('farm.save2new', 'save-new.png', 'save-new_f2.png', 'JTOOLBAR_SAVE_AND_NEW', false);
		}
		// If an existing item, can save to a copy.
//		if (!$isNew && $canDo->get('core.create')) {
//			JToolBarHelper::custom('item.save2copy', 'save-copy.png', 'save-copy_f2.png', 'JTOOLBAR_SAVE_AS_COPY', false);
//		}
		if (empty($this->item->id)) {
			JToolBarHelper::cancel('farm.cancel', 'JTOOLBAR_CANCEL');
		}
		else {
			JToolBarHelper::cancel('farm.cancel', 'JTOOLBAR_CLOSE');
		}
  
	}
}