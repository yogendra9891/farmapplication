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
	/**
	 * Configure the Linkbar.
	 */
	public static function addSubmenu($vName)
	{
		/*
		 * 
		 * here if clause is for showing the toolbar on the editing and adding a new item.... 
		 */
        if($vName == 'farm')
        {
        	$vName = 'farms';
        }
		JSubMenuHelper::addEntry(
			JText::_('COM_FARMAPP_FARMS'),
			'index.php?option=com_farmapp&view=farms',
			$vName == 'farms'
		);
		if($vName == 'zone')
		{
			$vName = 'zones';
		}
		JSubMenuHelper::addEntry(
			JText::_('COM_FARMAPP_ZONES'),
			'index.php?option=com_farmapp&view=zones',
			$vName == 'zones'
		);
		
	}

	/**
	 * Gets a list of the actions that can be performed.
	 *
	 * @return	JObject
	 * @since	1.6
	 */
	public static function getActions()
	{
		$user	= JFactory::getUser();
		$result	= new JObject;

		$assetName = 'com_farmapp';

		$actions = array(
			'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.own', 'core.edit.state', 'core.delete'
		);

		foreach ($actions as $action) {
			$result->set($action,	$user->authorise($action, $assetName));
		}
       
		return $result;
	}
}