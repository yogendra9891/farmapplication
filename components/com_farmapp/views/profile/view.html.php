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
jimport('joomla.html.toolbar');

//JLoader::import( 'com_farmapp.views._base', JPATH_ADMINISTRATOR.DS.'components' );

/**
 * HTML View class for the Farmapp component
 */
class ProfileViewProfile extends JView
{
	
	function display($tpl = null)
	{  
		//echo "test"; exit;
	//	var_dump($this->item); die;
	//	$this->addToolBar();
		parent::display($tpl);
		

	}
/**
* Setting the toolbar
 */
	function getToolbar() {
		// add required stylesheets from admin template
		$document    = & JFactory::getDocument();
		$document->addStyleSheet('administrator/templates/system/css/system.css');
		//now we add the necessary stylesheets from the administrator template
		//in this case i make reference to the bluestork default administrator template in joomla 1.6
		$document->addCustomTag(
			'<link href="administrator/templates/bluestork/css/template.css" rel="stylesheet" type="text/css" />'."\n\n".
			'<!--[if IE 7]>'."\n".
			'<link href="administrator/templates/bluestork/css/ie7.css" rel="stylesheet" type="text/css" />'."\n".
			'<![endif]-->'."\n".
			'<!--[if gte IE 8]>'."\n\n".
			'<link href="administrator/templates/bluestork/css/ie8.css" rel="stylesheet" type="text/css" />'."\n".
			'<![endif]-->'."\n".
			'<link rel="stylesheet" href="administrator/templates/bluestork/css/rounded.css" type="text/css" />'."\n"
			);
		//load the JToolBar library and create a toolbar
		jimport('joomla.html.toolbar');
		$bar = new JToolBar( 'toolbar' );
		//and make whatever calls you require
		$bar->appendButton( 'Standard', 'apply', 'Save', 'apply', false );
		$bar->appendButton( 'Separator' );
		$bar->appendButton( 'Standard', 'save', 'Save & close', 'save', false );
		//generate the html and return
		return $bar->render();
	}
		
}