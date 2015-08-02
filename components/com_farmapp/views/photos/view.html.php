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
//JLoader::import( 'com_farmapp.views._base', JPATH_ROOT.DS.'components' );
jimport('joomla.html.toolbar');
/**
 * View class for a list of Gnadmin.
 */
class PhotosViewPhotos extends JView
{

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{	
		
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
		$bar->appendButton( 'Standard', 'new', 'New', 'add', false );
		$editbutton = '<a class="toolbar" onclick="if (document.adminForm.boxchecked.value==0){alert(\'Please first make a selection from the list\');}else{ Joomla.submitbutton(\'edit\')}" href="#">
                       <span class="icon-32-edit"></span>Edit</a>';
		$deletebutton = '<a class="toolbar" onclick="if (document.adminForm.boxchecked.value==0){alert(\'Please first make a selection from the list\');}else{ Joomla.submitbutton(\'delete\')}" href="#">
						<span class="icon-32-trash"></span>Trash</a>';
		$publishbutton = '<a class="toolbar" onclick="if (document.adminForm.boxchecked.value==0){alert(\'Please first make a selection from the list\');}else{ Joomla.submitbutton(\'multiplepublish\')}" href="#">
                          <span class="icon-32-publish"></span>Publish</a>';
		$unpublishbutton = '<a class="toolbar" onclick="if (document.adminForm.boxchecked.value==0){alert(\'Please first make a selection from the list\');}else{ Joomla.submitbutton(\'multipleunpublish\')}" href="#">
                            <span class="icon-32-unpublish"></span>Unpublish</a>';
		$bar->appendButton('Custom',$editbutton);
		$bar->appendButton('Custom',$deletebutton);
		$bar->appendButton( 'Separator' );
		$bar->appendButton('Custom',$publishbutton);
		$bar->appendButton('Custom',$unpublishbutton);
		//generate the html and return
		return $bar->render();
	}

/*
 * 
 * getting the published state on the front end..........
 */	
	
	public function getPublished($status, $id){
		$html = '<a class="jgrid" href="javascript:void(0);" checkedid="'.$id.'">';

		if($status){
			$html .= '<span class="state publish"><span class="text text'.$id.'">'.$status.'</span></span>';
		}else{
			$html .= '<span class="state unpublish"><span class="text text'.$id.'">'.$status.'</span></span>';
		}
		$html .= "</a>";

		return $html;
	}
	
	
}