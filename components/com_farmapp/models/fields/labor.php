<?php
// No direct access to this file
defined('_JEXEC') or die;
 
// import the list field type
JLoader::import( 'com_farmapp.helpers.farmapp', JPATH_ROOT.DS.'components' );
JFormHelper::loadFieldClass('list');
 
/**
 *  Form Field class for the farm component
 */
class JFormFieldLabor extends JFormFieldList
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	protected $type = 'Labor';

	/**
	 * Method to get the field options.
	 *
	 * @return	array	The field option objects.
	 * @since	1.6
	 */
	public function getOptions()
	{
		
		return FarmappHelper::getLaborOptions();
	}
	
	
}
