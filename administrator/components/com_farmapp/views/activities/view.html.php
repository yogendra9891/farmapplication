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
class ActivitiesViewActivities extends FarmViewBase
{

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{	
		
		parent::display($tpl);
	}
		/*
	 * 
	 * Method to get the activity status for the activity form
	 */
	function getActivityStatus(){

		$options = array(open=>'open', close=>'close');		
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