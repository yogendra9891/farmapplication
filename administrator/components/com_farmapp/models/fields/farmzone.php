<?php
// No direct access to this file
defined('_JEXEC') or die;
 
// import the list field type
JLoader::import( 'com_farmapp.helpers.farmapp', JPATH_ADMINISTRATOR.DS.'components' );
JFormHelper::loadFieldClass('list');
 
/**
 * HelloWorld Form Field class for the farm component
 */
class JFormFieldFarmZone extends JFormFieldList
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	protected $type = 'FarmZone';

	/**
	 * Method to get the field options.
	 *
	 * @return	array	The field option objects.
	 * @since	1.6
	 */
	public function getOptions()
	{
		
		return FarmappHelper::getFarmZoneOptions();
	}
	
	
}
