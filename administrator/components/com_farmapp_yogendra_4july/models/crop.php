<?php
/**
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;
// import Joomla modelform library
jimport('joomla.application.component.modeladmin');


class CropsModelCrop extends JModelAdmin
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
		$form = $this->loadForm('com_farmapp.crop','crop', array('load_data' => $loadData));
	
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
	{     //  var_dump($data); die;
			$cid = JRequest::getVar( 'cid');
			$expval=explode('/',$data['farmzonecrop']);
			$data['farm']=$expval[0];
			$data['zone_id']=$expval[1];
			$row =& $this->getTable('Crop','CropTable');
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
		$table = $this->getTable('Crop','CropTable');
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
		$item->farmzonecrop=$item->farm.'/'.$item->zone_id;
		return $item;
	}

	
}
