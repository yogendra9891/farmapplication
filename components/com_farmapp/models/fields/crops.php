<?php
// No direct access to this file
defined('_JEXEC') or die;
 
// import the list field type
JLoader::import( 'com_farmapp.helpers.farmapp', JPATH_ROOT.DS.'components' );
JFormHelper::loadFieldClass('list');
 
/**
 * Crops Form Field class for the farm component
 */
class JFormFieldCrops extends JFormFieldList
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	protected $type = 'Crops';

	/**
	 * Method to get the field options.
	 *
	 * @return	array	The field option objects.
	 * @since	1.6
	 */
	protected function getOptions()
	{
		$db = &JFactory::getDBO();
		$userid = JFactory::getUser()->id;
		$query1 = $db->getQuery(true);
		// Select a single field from the farm table according the login user.......
		$query1->select('f.id');
		$query1->from('#__farm as f');
		$query1->where('f.userid = '.$userid);
		$db->setQuery($query1);
        $farmid = $db->loadResult();
        
		$db = &JFactory::getDBO();
        $query = $db->getQuery(true);
        $query->select('c.id As value, c.name As text');
		$query->from('#__crop AS c');
		
		$query->where(' c.farm = '.$farmid);
		$query->order(' c.name');

        $db->setQuery($query);
        $options = $db->loadObjectList();

        array_unshift($options, JHtml::_('select.option', '0', JText::_('Select Crop')));    
        return $options;
	}


}
