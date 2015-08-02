<?php
/**
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');

/**
 * Weblinks model.
 *
 * @package		Joomla.Administrator
 * @subpackage	com_farmapp
 * @since		1.5
 */
class FarmappModelFarm extends JModelAdmin
{
	/**
	 * @var		string	The prefix to use with controller messages.
	 * @since	1.6
	 */
	protected $text_prefix = 'COM_FARMAPP';

	/**
	 * Method to test whether a record can be deleted.
	 *
	 * @param	object	A record object.
	 * @return	boolean	True if allowed to delete the record. Defaults to the permission set in the component.
	 * @since	1.6
	 */
	protected function canDelete($record)
	{
		if (!empty($record->id)) {
			if ($record->state != -2) {
				return ;
			}
			$user = JFactory::getUser();

			if ($record->catid) {
				return $user->authorise('core.delete', 'com_farmapp.category.'.(int) $record->catid);
			}
			else {
				return parent::canDelete($record);
			}
		}
	}

	/**
	 * Method to test whether a record can have its state changed.
	 *
	 * @param	object	A record object.
	 * @return	boolean	True if allowed to change the state of the record. Defaults to the permission set in the component.
	 * @since	1.6
	 */
	protected function canEditState($record)
	{ //  echo "edit state os tjhe farm"; exit;
		//var_dump($record); die;
		$user = JFactory::getUser();

		if (!empty($record->id)) {
			return $user->authorise('core.edit.state', 'com_farms.farm.'.(int) $record->id);
		}
		else { 
			return parent::canEditState($record);
		}
	}
	/**
	 * Returns a reference to the a Table object, always creating it.
	 *
	 * @param	type	The table type to instantiate
	 * @param	string	A prefix for the table class name. Optional.
	 * @param	array	Configuration array for model. Optional.
	 * @return	JTable	A database object
	 * @since	1.6
	 */
	public function getTable($type = 'Farm', $prefix = 'FarmappTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	/**
	 * Method to get the record form.
	 *
	 * @param	array	$data		An optional array of data for the form to interogate.
	 * @param	boolean	$loadData	True if the form is to load its own data (default case), false if not.
	 * @return	JForm	A JForm object on success, false on failure
	 * @since	1.6
	 */
	public function getForm($data = array(), $loadData = true)
	{
		// Initialise variables.
		$app	= JFactory::getApplication();

		// Get the form.
		$form = $this->loadForm('com_farmapp.farm', 'farm', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) {
			return false;
		}

		// Determine correct permissions to check.
		if ($this->getState('farm.id')) {
			// Existing record. Can only edit in selected categories.
			$form->setFieldAttribute('id', 'action', 'core.edit');
		} else {
			// New record. Can only create in selected categories.
			$form->setFieldAttribute('id', 'action', 'core.create');
		}

		// Modify the form based on access controls.
		if (!$this->canEditState((object) $data)) {
			// Disable fields for display.
//			$form->setFieldAttribute('ordering', 'disabled', 'true');
//			$form->setFieldAttribute('status', 'disabled', 'true');
//			$form->setFieldAttribute('publish_up', 'disabled', 'true');
//			$form->setFieldAttribute('publish_down', 'disabled', 'true');

			// Disable fields while saving.
			// The controller has already verified this is a record you can edit.
//			$form->setFieldAttribute('ordering', 'filter', 'unset');
//			$form->setFieldAttribute('status', 'filter', 'unset');
//			$form->setFieldAttribute('publish_up', 'filter', 'unset');
//			$form->setFieldAttribute('publish_down', 'filter', 'unset');
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
		$data = JFactory::getApplication()->getUserState('com_farmapp.edit.farm.data', array());
		if (empty($data)) {
			$data = $this->getItem();
			// Prime some default values.
			if ($this->getState('farm.id') == 0) {
				$app = JFactory::getApplication();
				$data->set('id', JRequest::getInt('id', $app->getUserState('com_farmapp.farms.filter.id')));
			}
		}
 		return $data;
	}

	/**
	 * Method to get a single record.
	 *
	 * @param	integer	The id of the primary key.
	 *
	 * @return	mixed	Object on success, false on failure.
	 * @since	1.6
	 */
	public function getItem($pk = null)
	{
		if ($item = parent::getItem($pk)) {
			// Convert the params field to an array.
			$registry = new JRegistry;
			$registry->loadString($item->keywords_tags);
			$item->keywords_tags = $registry->toArray();
			$registry->loadString($item->social_media_links);
			$item->social_media_links = $registry->toArray();
		}
		return $item;
	}

	/**
	 * Prepare and sanitise the table prior to saving.
	 *
	 * @since	1.6
	 */
	protected function prepareTable(&$table)
	{
		$date = JFactory::getDate();
		$user = JFactory::getUser();

		$table->name		= htmlspecialchars_decode($table->name, ENT_QUOTES);
	//	$table->alias		= JApplication::stringURLSafe($table->alias);

//		if (empty($table->alias)) {
//			$table->alias = JApplication::stringURLSafe($table->title);
//		}

		if (empty($table->id)) {
			// Set the values

			// Set ordering to the last item if not set
//			if (empty($table->ordering)) {
//				$db = JFactory::getDbo();
//				$db->setQuery('SELECT MAX(ordering) FROM #__weblinks');
//				$max = $db->loadResult();
//
//				$table->ordering = $max+1;
//			}
		}
		else {
			// Set the values
		}
	}

	/**
	 * A protected method to get a set of ordering conditions.
	 *
	 * @param	object	A record object.
	 * @return	array	An array of conditions to add to add to ordering queries.
	 * @since	1.6
	 */
	protected function getReorderConditions($table)
	{
		$condition = array();
		$condition[] = 'id = '.(int) $table->id;
		return $condition;
	}
}