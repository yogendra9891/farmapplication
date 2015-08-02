<?php
/**
 * @version     1.0.0
 * @package     com_farmapp
 * @copyright   Copyright (C) 2012. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Created by com_combuilder - http://www.notwebdesign.com
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');
JLoader::import( 'com_farmapp.views._base', JPATH_ADMINISTRATOR.DS.'components' );

/**
 * View class for a list of Gnadmin.
 */
class BedsViewBeds extends FarmViewBase
{

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{	
		
		parent::display($tpl);
	}
	
	
}