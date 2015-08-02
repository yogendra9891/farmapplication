<?php
/**
 * @version     1.0.0
 * @package     com_farmapp
 * @copyright   Copyright (C) 2012. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Created by com_combuilder - http://www.notwebdesign.com
 */

// No direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

/**
 * Items list controller class.
 */
class FarmappControllerFarms extends JControllerAdmin
{
	public function __construct()
	{
	  parent::__construct();
	  $this->registerTask('remove','delete');
	  $this->registerTask('multiplepublish','multiplepublish');
	  $this->registerTask('multipleunpublish','multipleunpublish');
	}
	/**
	 * Proxy for getModel.
	 * @since	1.6
	 */
	public function getModel($name = 'Farms', $prefix = 'FarmappModel')
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
	//	echo"fdf"; 
	//	var_dump($model); die;
		return $model;
	}
	
	/*
	 * Method for deleting single/multiple farms......
	 * 
	 */
	public function delete()
	{
	 // echo "test"; exit;
	 $model = $this->getModel('farms');
	 if(!$model->delete()) {
	 $msg = JText::_( 'Error: One or More farms Could not be Deleted' );
	 } else {
		        $msg = JText::_( 'farm(s) Deleted' );
		    }
	 $link = 'index.php?option=com_farmapp&view=farms';
	 $this->setRedirect($link, $msg);
		
	}
	/*
	 * Method for publish single/multiple farms......
	 * 
	 */
	public function multiplepublish()
	{
	 // echo "test"; exit;
	 $model = $this->getModel('farms');
	 if(!$model->multiplepublish()) {
	 $msg = JText::_( 'Error: One or More farms Could not be published' );
	 } else {
		        $msg = JText::_( 'farm(s) Published.' );
		    }
	 $link = 'index.php?option=com_farmapp&view=farms';
	 $this->setRedirect($link, $msg);
		
	}	
		/*
	 * Method for unpublish single/multiple farms......
	 * 
	 */
	public function multipleunpublish()
	{
	 $model = $this->getModel('farms');
	 if(!$model->multipleunpublish()) {
	 $msg = JText::_( 'Error: One or More farms Could not be unpublished' );
	 } else {
		        $msg = JText::_( 'farm(s) UnPublished.' );
		    }
	 $link = 'index.php?option=com_farmapp&view=farms';
	 $this->setRedirect($link, $msg);
		
	}	
}