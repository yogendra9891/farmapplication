<?php
/**
 * @version     1.0.0
 * @package     com_farmapp
 * @copyright   Copyright (C) 2012. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Created by com_combuilder - http://www.notwebdesign.com
 */


// no direct access
defined('_JEXEC') or die;
 
// import joomla controller library
jimport('joomla.application.component.controller');
 
// Require the base controller
require_once JPATH_COMPONENT.DS.'controller.php';

// Perform the Request task
$input = JFactory::getApplication()->input;

// Initialize the controller
$controller = JRequest::getWord('controller',$input->getVar('view','farm') ); 
 
// Create the controller
require_once( JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php');
$classname = ucfirst($controller).'ControllerFarmapp';   

// Get an instance of the controller prefixed by FarmApp
$controller = new $classname();

$controller->execute($input->getCmd('task'));
 
// Redirect if set by the controller
$controller->redirect();

