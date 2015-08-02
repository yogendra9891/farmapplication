<?php
/**
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;
// import Joomla modelform library
jimport('joomla.application.component.modeladmin');


class FarmsModelFarm extends JModelAdmin
{
	
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
		$form = $this->loadForm('com_farmapp.farm','farm', array('load_data' => $loadData));
	
		if (empty($form)) 
		{
			return false;
		}
	
		
		return $form;
	}
	
/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return	mixed	The data for the form.
	 * @since	1.6
	 */
	protected function loadFormData() 
	{
		// Check the session for previously entered form data.
		//$data = JFactory::getApplication()->getUserState('com_farmapp.edit.farm.data', array());
		
			$data = $this->getItem();
		
		return $data;
	}
	
	
/**
	 * Method to save data and gettable object in the form.
	 *
	 */
	public function save($data) 
	{
			$cid = JRequest::getVar( 'cid');
			
			$row =& $this->getTable('Farm','FarmTable');
			if($cid >0)
			{
			$row->load($cid,'id');
			}
			$row->bind($data);
			
		 	$row->store($data);
		 	return $row->id;
	}
	
/**
	 * Method to get a single record.
	 *
	 * @param   integer  $pk  The id of the primary key.
	 *
	 * @return  mixed    Object on success, false on failure.
	 *
	 * @since   11.1
	 */
	public function getItem($pk = null)
	{
		
		// Initialise variables.
		//$pk = (!empty($pk)) ? $pk : (int) $this->getState($this->getName() . '.id');
		$table = $this->getTable('Farm','FarmTable');
		if ($pk > 0)
		{
			// Attempt to load the row.
			$return = $table->load($pk,'id');

			// Check for a table object error.
			if ($return === false && $table->getError())
			{
				$this->setError($table->getError());
				return false;
			}
		}

		// Convert to the JObject before adding other data.
		$properties = $table->getProperties(1);
		
		$item = JArrayHelper::toObject($properties, 'JObject');

		if (property_exists($item, 'keywords_tags'))
		{
			// Convert the params field to an array.
			$registry = new JRegistry;
			$registry->loadString($item->keywords_tags);
			$item->keywords_tags = $registry->toArray();
			$registry->loadString($item->social_media_links);
			$item->social_media_links = $registry->toArray();
		}

		return $item;
	}

	
}