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
 * View class for a list of Gnadmin.
 */
class FarmappViewFarms extends JView
{
	protected $items;
	protected $pagination;
	protected $state;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{  // echo "display of view farms"; exit;

		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		$this->state		= $this->get('State');
		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		$this->addToolbar();
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @since	1.6
	 */
	protected function addToolbar()
	{   // echo "addTollbar"; exit;
		require_once JPATH_COMPONENT.DS.'helpers'.DS.'farmapp.php';
    	$state	= $this->get('State');
		$canDo	= FarmappHelper::getActions();

		JToolBarHelper::title(JText::_('COM_FARMAPP_TITLE_FARMS'), 'farmapp.png');

        //Check if the form exists before showing the add/edit buttons
        $formPath = JPATH_COMPONENT_ADMINISTRATOR.DS.'views'.DS.'farm';
        if (file_exists($formPath)) {

            if ($canDo->get('core.create')) {
			    JToolBarHelper::addNew('farm.add','JTOOLBAR_NEW');
		    }

		    if ($canDo->get('core.edit')) {
			    JToolBarHelper::editList('farm.edit','JTOOLBAR_EDIT');
		    }

        }
        //Show trash and delete for components that uses the state field
        if (isset($this->items[0]->status)) {
		    if ($canDo->get('core.delete')) {
			    JToolBarHelper::trash('farms.remove','JTOOLBAR_TRASH');
			    JToolBarHelper::divider();
		    } else if ($canDo->get('core.edit.status')) {
			    JToolBarHelper::trash('farms.trash','JTOOLBAR_TRASH');
			    JToolBarHelper::divider();
		    }
        }
        
		if ($canDo->get('core.edit.state')) {

            if (isset($this->items[0]->status)) {
			    JToolBarHelper::custom('farms.multiplepublish', 'publish.png', 'publish_f2.png','JTOOLBAR_PUBLISH', true);
			    JToolBarHelper::custom('farms.multipleunpublish', 'unpublish.png', 'unpublish_f2.png', 'JTOOLBAR_UNPUBLISH', true);
			    JToolBarHelper::divider();
            } else {
                //If this component does not use state then show a direct delete button as we can not trash
                JToolBarHelper::deleteList('', 'farms.delete','JTOOLBAR_DELETE');
                JToolBarHelper::divider();
            }

		}
        

		if ($canDo->get('core.admin')) {
			JToolBarHelper::preferences('com_farmapp');
		}

	}
}