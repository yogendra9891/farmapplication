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
// import Joomla controller library
jimport('joomla.application.component.controlleradmin');

 

class FarmappController extends JControllerAdmin
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
		$this->registerTask('add',	'edit');
		$this->registerTask('edit',	'edit');
		$this->registerTask('save2new',	'save');
		$this->registerTask('save',	'save');
		$this->registerTask('apply','save');
	}
	
	
}