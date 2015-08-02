<?php


/** ensure this file is being included by a parent file */
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.view' );

class FarmViewBase extends JView
{
 	/*
	 * Submenu list
	 */
	protected $_subMenu=array('farms'=>'Farms');
	
  
/*
    * set sub menu on view
    * 
    * @param None
    * @return 
    */	
   protected function setSubMenu()
   {		
		foreach($this->_subMenu as $key => $val)
		{
			$current = strtolower( JRequest::getVar('view', 'farms') );
			//echo $current;
			$active = ($key == $current );
			JSubMenuHelper::addEntry(JText::_($val), 'index.php?option=com_farm&view='.$key, $active );
		} 
	}

	
	
}
	
	
