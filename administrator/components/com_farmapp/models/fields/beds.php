<?php
// No direct access to this file
defined('_JEXEC') or die;
 
// import the list field type
JLoader::import( 'com_farmapp.helpers.farmapp', JPATH_ADMINISTRATOR.DS.'components' );
JFormHelper::loadFieldClass('list');
 
/**
 * Plants Form Field class for the farm component
 */
class JFormFieldBeds extends JFormFieldList
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	protected $type = 'Beds';

	/**
	 * Method to get the field options.
	 *
	 * @return	array	The field option objects.
	 * @since	1.6
	 */
	protected function getOptions()
	{
		$db = &JFactory::getDBO();

        $query = "SELECT c.id, c.name from `#__bed` As c";
        $db->setQuery($query);
        $options = $db->loadObjectList();

        
		$list = array();
        $list[] = JHTML::_('select.option', '', "- ".JText::_("Select a Bed")." -" );
        
        foreach(@$options as $option)
        {
            $key = $option->id;
            $option_value = $option->name;
            $list[] = JHTML::_('select.option', $key, $option_value );
        }
    
        return $list;
	}


}
