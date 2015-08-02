<?php
/**
 * @version     1.0.0
 * @package     com_gnadmin
 * @copyright   Copyright (C) 2012. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Created by com_combuilder - http://www.notwebdesign.com
 */

// No direct access
defined('_JEXEC') or die;

/**
 * Gnadmin helper.
 */
class FarmappHelper
{
	/* function to list option of farm as dropdown*/
	public static function getFarmOptions()
	{
		// Initialize variables.
		$options = array();

		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);

		$query->select('id As value, name As text');
		$query->from('#__farm AS a');
		$query->order('a.name');

		// Get the options.
		$db->setQuery($query);

		$options = $db->loadObjectList();

		// Check for a database error.
		if ($db->getErrorNum()) {
			JError::raiseWarning(500, $db->getErrorMsg());
		}

		// Merge any additional options in the XML definition.
		//$options = array_merge(parent::getOptions(), $options);

		array_unshift($options, JHtml::_('select.option', '0', JText::_('Select Farm')));

		return $options;
	}
	
	
	/* function to list option of zone as dropdown*/
	public static function getZoneOptions()
	{
		// Initialize variables.
		$options = array();

		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);

		$query->select('id As value, name As text');
		$query->from('#__zone AS a');
		$query->order('a.name');

		// Get the options.
		$db->setQuery($query);

		$options = $db->loadObjectList();

		// Check for a database error.
		if ($db->getErrorNum()) {
			JError::raiseWarning(500, $db->getErrorMsg());
		}

		// Merge any additional options in the XML definition.
		//$options = array_merge(parent::getOptions(), $options);

		array_unshift($options, JHtml::_('select.option', '0', JText::_('Select Zone')));

		return $options;
	}
	
/* function to list option of in fromat zone as dropdown*/
	public static function getFarmZoneOptions()
	{
		
		// Initialize variables.
		$options = array();

		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);

		$query->select('CONCAT_WS("/", a.id, b.id) As value, CONCAT_WS("/", a.name, b.name) As text');
		$query->from('#__farm AS a');
		$query->innerjoin('#__zone AS b ON b.farm=a.id');
		$query->order('a.name');
  
		// Get the options.
		$db->setQuery($query);

		$options = $db->loadObjectList();

		// Check for a database error.
		if ($db->getErrorNum()) {
			JError::raiseWarning(500, $db->getErrorMsg());
		}

		// Merge any additional options in the XML definition.
		//$options = array_merge(parent::getOptions(), $options);

		array_unshift($options, JHtml::_('select.option', '0', JText::_('Select')));

		return $options;
	}
	/* function to list option of in fromat farm/zones in crop edit as dropdown*/
	public static function getFarmZoneCropOptions()
	{
		
		// Initialize variables.
		$options = array();

		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);

		$query->select('CONCAT_WS("/", a.id, b.id) As value, CONCAT_WS("/", a.name, b.name) As text');
		$query->from('#__farm AS a');
		$query->innerjoin('#__zone AS b ON b.farm=a.id');
		$query->order('a.name');
  
		// Get the options.
		$db->setQuery($query);

		$options = $db->loadObjectList();

		// Check for a database error.
		if ($db->getErrorNum()) {
			JError::raiseWarning(500, $db->getErrorMsg());
		}

		// Merge any additional options in the XML definition.
		//$options = array_merge(parent::getOptions(), $options);
       
		array_unshift($options, JHtml::_('select.option', '0', JText::_('Select Farm/Zone')));

		return $options;
	}
		
	/*
	 * 
	 * edit by yogendra for getting the plants name and id in crops view........
	 */
	
	public static function getPlantOptions()
	{
		// Initialize variables.
		$options = array();

		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);

		$query->select('id As value, name As text');
		$query->from('#__plant_variety AS a');
		$query->order('a.name');

		// Get the options.
		$db->setQuery($query);

		$options = $db->loadObjectList();

		// Check for a database error.
		if ($db->getErrorNum()) {
			JError::raiseWarning(500, $db->getErrorMsg());
		}

		// Merge any additional options in the XML definition.
		//$options = array_merge(parent::getOptions(), $options);

		array_unshift($options, JHtml::_('select.option', '0', JText::_('Select Plant')));

		return $options;
	}
	
/* function to list option of farm as dropdown*/
	public static function getLaborOptions()
	{
		// Initialize variables.
		$options = array();

		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);

		$query->select('id As value, name As text');
		$query->from('#__labor_category AS a');
		$query->order('a.name');

		// Get the options.
		$db->setQuery($query);

		$options = $db->loadObjectList();

		// Check for a database error.
		if ($db->getErrorNum()) {
			JError::raiseWarning(500, $db->getErrorMsg());
		}

		// Merge any additional options in the XML definition.
		//$options = array_merge(parent::getOptions(), $options);

		array_unshift($options, JHtml::_('select.option', '0', JText::_('Select Labor Category')));

		return $options;
	}
	/*
	 * 
	 * Method for the Activity Options...(Open/closed..)
	 * 
	 */
	public static function getActivityOptions()
	{
	// $optionss = array();
	 $optionss = array(1=>'open', 2=>'closed');
	 array_unshift($optionss, JHtml::_('select.option', '0', JText::_('Select Status')));
	 return $optionss;
	}
	/**
	 * Gets a list of the actions that can be performed.
	 *
	 * @return	JObject
	 * @since	1.6
	 */
	public static function getActions()
	{
		jimport('joomla.access.access');
		$user	= JFactory::getUser();
		$result	= new JObject;

		$assetName = 'com_farmapp';

		$actions = JAccess::getActions('com_farmapp', 'component');
 
		foreach ($actions as $action) {
			$result->set($action->name, $user->authorise($action->name, $assetName));
		}
 
		return $result;		return $result;
	}
		
	
}