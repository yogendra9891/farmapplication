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


/**
 * Items list controller class.
 */
class ReportControllerFarmapp extends FarmappController
{
	
	/**
	 * Constructor.
	 *
	 * @param	array	$config	An optional associative array of configuration settings.
	 
	 * @see		JController
	 * @since	1.6
	 */
	public function __construct($config = array())
	{
		
		parent::__construct($config);

	}
	
	
	function display()
	{
	 // echo "test"; exit;
		$model=$this->getModel('report');
		
		$actform=$model->getForm('actreport');
		$finform=$model->getFinForm('finreport');
		$view=$this->getView('report','html');
		$view->assign('actform',$actform);
		$view->assign('finform',$finform);
		
		$view->display();
	}
	
	/*
	 * method is calling from function.js file coming an ajax call to finding the zone from  according to the farm..
	 */
	
	public function findzone()
	{
		$farmid = (int)JRequest::getvar('val');
		$model=$this->getModel('report');
		$zonelist = $model->getzonesfromfarm($farmid);
		
		echo $zonelist;
	}
	
	/*
	 * method is calling from function.js file coming an ajax call to finding the beds from  according to the Farm / Zone..
	 * 
	 */
	public function findbeds()
	{
		$farmid = (int)JRequest::getvar('val');
		$zoneid = (int)JRequest::getvar('zoneid');
		$model=$this->getModel('report');
		$bedslist = $model->getbedsfromfarmzone($farmid, $zoneid);
		
		echo $bedslist;
	}
	
   /*
    * 
    * Activity report taskk....
    */
	public function activityreport()
	{
		$model=$this->getModel('report');
		$startdate = JRequest::getvar('startdate');
		$enddate = JRequest::getvar('enddate');
		$cropid = (int)JRequest::getvar('crop');
		$farmid = (int)JRequest::getvar('farm');
		$zoneid = (int)JRequest::getvar('zone');
		$bedid = (int)JRequest::getvar('bed');
		$layout = JRequest::getvar('layout');
		$data = array($startdate, $enddate, $cropid, $farmid, $zoneid, $bedid);
		$items = $model->getactivitiesreoprt($data); 
		$actform=$model->getForm('actreport');
//		$state = $model->getState();
		$view = $this->getView('report','html');
//		$view->assign('state',$state);
		$view->assign('items',$items);
		$view->assign('data',$data);
		$view->setLayout('activityreport');
		$view->assign('actform',$actform);
//		$view->assign('finform',$finform);
		
		$view->display();
		
	}
   /*
    * 
    * Profilt/Loss report taskk....
    */
	public function profitlossreport()
	{   
		$model=$this->getModel('report');
		$startdate = JRequest::getvar('pstartdate');
		$enddate = JRequest::getvar('penddate');
		$cropid = (int)JRequest::getvar('pcrop');
		$farmid = (int)JRequest::getvar('farm');
		$zoneid = (int)JRequest::getvar('zone');
		$bedid = (int)JRequest::getvar('bed');
		$layout = JRequest::getvar('layout');
		$data = array($startdate, $enddate, $cropid, $farmid, $zoneid, $bedid); //var_dump($data); die;
		$items = $model->getprofitlossreoprt($data); 
		$finform=$model->getFinForm('finreport');
		$view = $this->getView('report','html');
		$view->assign('items',$items);
		$view->assign('data',$data);
		$view->setLayout('finreport');
		$view->assign('finform',$finform);
		$view->display();
		
	}
	
	
}