<?php
// No direct access to this file
defined('_JEXEC') or die;
 
// import the list field type
//Here JPATH_ROOT is showing the path of the compoennet at the front end........
JLoader::import( 'com_farmapp.helpers.farmapp', JPATH_ROOT.DS.'components' );
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
		$options = array();
		$db = JFactory::getDBO();
		$userid = JFactory::getUser()->id;
		$query1 = $db->getQuery(true);
		// Select a single field from the farm table according the login user.......
		$query1->select('f.id');
		$query1->from('#__farm as f');
		$query1->where('f.userid = '.$userid);
		$db->setQuery($query1);
        $farmid = $db->loadResult();
//	var_dump($farmid); die;	
		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);

		$query->select('id As value, name As text');
		$query->from('#__bed AS a');
		$query->where('a.farm = '.$farmid);
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

		array_unshift($options, JHtml::_('select.option', '0', JText::_('Select Bed')));

		return $options;
			}


}
