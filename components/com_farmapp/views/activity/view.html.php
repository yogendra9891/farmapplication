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
//JLoader::import( 'com_farmapp.views._base', JPATH_ADMINISTRATOR.DS.'components' );
jimport('joomla.html.toolbar');
require_once JPATH_COMPONENT .'/helpers/farmapp.php';
/**
 * HTML View class for the Gnadmin component
 */
class ActivitiesViewActivity extends JView
{
	
	function display($tpl = null)
	{  //echo "display"; exit;
		
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
		$bar->appendButton( 'Standard', 'save-new', 'Save & New', 'save2new', false );
		$bar->appendButton( 'Standard', 'cancel', 'Cancel', 'cancel', false );
		//generate the html and return
		return $bar->render();
	}
	
	/**
	 * Method to get the activity mode for the activity form
	 */
	function getActivityMode(){

		$options = array(crop=>'crop', plug=>'plug', seed=>'seed');		
		// Initialize JavaScript field attributes.
		$html = '';
		$values = isset($this->item->activity_mode) ? explode(',', $this->item->activity_mode) : array();
		$class = ' class="checkrequired"';
		$html .= '<label title="Activity Mode" class="hasTip required" for="activity_mode" id="activity_mode-lbl">Mode</label>';
		foreach(@$options as $key=>$option)
		{
			$checked	= ($key == $this->item->activity_mode) ? ' checked="checked"' : '';
			$html .= '<span style="float:left; width: 70px;"><input style="float:left; position: relative;z-index: 99;" type="radio" name="activity_mode" id="activity_mode_'.$key.'"' .
				' value="'.htmlspecialchars((string) $key, ENT_COMPAT, 'UTF-8').'"' .
			$class.$checked.'/><label style="float: left; margin: -19px 0 0; min-width: 8% !important; padding: 0 0 0 20px;" class="groupboxlabel">'.$option.'</label></span>';
		}
		return $html;
}
	
	/**
	 * Method to get the activity type for the activity form
	 */
	function getActivityType(){

		$options = array(Planting=>'Planting', Amending=>'Amending', Pruning=>'Pruning', Weeding=>'Weeding', Watering=>'Watering', Harvesting=>'Harvesting');		
		// Initialize JavaScript field attributes.
		$html = '';
		$values = isset($this->item->activity_type) ? explode(',', $this->item->activity_type) : array();
		
		$html .= '<label title="Activity type" class="hasTip required" for="activity_type" id="activity_type-lbl">Activity Types</label>';
    	$html .= '<select id="activity_type" class="activitytype" name="activity_type" size="1">';
		foreach(@$options as $key=>$option)
		{
			$selected	= ($key == $this->item->activity_type) ? 'selected="selected"' : '';
			$html .= '<option value="'. htmlspecialchars((string) $key, ENT_COMPAT, 'UTF-8').'"'.$selected.'>'.$option.'</option>';
		}
		$html .= '</select>';
		return $html;
	}

	
		/**
	 * Method to get the activity type for the activity form
	 */
	function getUnitMeasureType(){

		$options = array(all=>'all', each=>'each', bushels=>'bushels', pounds=>'pounds', kilos=>'kilos');		
		// Initialize JavaScript field attributes.
		$html = '';
		$values = isset($this->item->activity_type) ? explode(',', $this->item->activity_type) : array();
		
		$html .= '<label title="Unit of Measure" class="hasTip required" for="unit_of_measure" id="unit_of_measure-lbl">Unit of Measure</label>';
    	$html .= '<select id="unit_of_measure" class="unit_of_measure" name="unit_of_measure" size="1">';
		foreach(@$options as $key=>$option)
		{
			$selected	= ($key == $this->item->activity_type) ? 'selected="selected"' : '';
			$html .= '<option value="'. htmlspecialchars((string) $key, ENT_COMPAT, 'UTF-8').'"'.$selected.'>'.$option.'</option>';
		}
		$html .= '</select>';
		return $html;
	}

	
	/*
	 * 
	 * Method to get the activity status for the activity form
	 */
	function getActivityStatus(){

		$options = array(open=>'open', closed=>'closed');		
		// Initialize JavaScript field attributes.
		$html = '';
		$values = isset($this->item->activity_status) ? explode(',', $this->item->activity_status) : array();
		
		$html .= '<label title="Activity Status" class="hasTip required" for="activity_status" id="activity_status-lbl">Activity Status</label>';
    	$html .= '<select id="activity_status" class="activity_status" name="activity_status" size="1">';
		foreach(@$options as $key=>$option)
		{
			$selected	= ($key == $this->item->activity_status) ? 'selected="selected"' : '';
			$html .= '<option value="'. htmlspecialchars((string) $key, ENT_COMPAT, 'UTF-8').'"'.$selected.'>'.$option.'</option>';
		}
		$html .= '</select>';
		return $html;
	}
	
}