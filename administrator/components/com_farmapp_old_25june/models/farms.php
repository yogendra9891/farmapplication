<?php
/**
 * @version     1.0.0
 * @package     com_farmapp
 * @copyright   Copyright (C) 2012. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Created by com_combuilder - http://www.notwebdesign.com
 */

defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

/**
 * Methods supporting a list of farms records.
 */
class FarmappModelFarms extends JModelList
{

    /**
     * Constructor.
     *
     * @param    array    An optional associative array of configuration settings.
     * @see        JController
     * @since    1.6
     */
    public function __construct($config = array())
    {   //echo "farms model"; exit;
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                
            );
        }

        parent::__construct($config);
    }


	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 */
	protected function populateState($ordering = null, $direction = null)
	{
		// Initialise variables.
		$app = JFactory::getApplication('administrator');

		// Load the filter state.
		$search = $app->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		$published = $app->getUserStateFromRequest($this->context.'.filter.status', 'filter_published', '', 'string');
		$this->setState('filter.status', $published);

		// Load the parameters.
		$params = JComponentHelper::getParams('com_farmapp');
		$this->setState('params', $params);

		// List state information.
		parent::populateState('a.name', 'asc');
	}

	/**
	 * Method to get a store id based on model configuration state.
	 *
	 * This is necessary because the model is used by the component and
	 * different modules that might need different sets of data or different
	 * ordering requirements.
	 *
	 * @param	string		$id	A prefix for the store id.
	 * @return	string		A store id.
	 * @since	1.6
	 */
	protected function getStoreId($id = '')
	{
		// Compile the store id.
		$id.= ':' . $this->getState('filter.search');
		$id.= ':' . $this->getState('filter.status');

		return parent::getStoreId($id);
	}

	/**
	 * Build an SQL query to load the list data.
	 *
	 * @return	JDatabaseQuery
	 * @since	1.6
	 */
	protected function getListQuery()
	{
		// Create a new query object.
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);

		// Select the required fields from the table.
		$query->select(
			$this->getState(
				'list.select',
				'a.*'
			)
		);
		$query->from('`#__farm` AS a');





		// Filter by search in title
		$search = $this->getState('filter.search');
		if (!empty($search)) {
			if (stripos($search, 'id:') === 0) {
				$query->where('a.id = '.(int) substr($search, 3));
			} else {
				$search = $db->Quote('%'.$db->getEscaped($search, true).'%');
                $query->where('a.name LIKE' .$search);
			}
		}

		// Add the list ordering clause.
		$orderCol	= $this->state->get('list.ordering');
		$orderDirn	= $this->state->get('list.direction');
		//echo $orderCol; exit;
        if ($orderCol && $orderDirn) {
		    $query->order($db->getEscaped($orderCol.' '.$orderDirn));
        }
    //  echo $query; exit;
		return $query;
	}

	/*
	 * function is for doing the publish/unpublish the farm in default.php of farms templates..
	 * 
	 */
	public function publish($pks = null, $state = 1, $userId = 0)
	{ 
		// Sanitize input.
		JArrayHelper::toInteger($pks);
		$userId = (int) $userId;
		$state  = (int) $state;
		$id = $pks[0];
		// If there are no primary keys set check to see if the instance key is set.
		if (empty($pks))
		{
			if ($this->$k) {
				$pks = array($this->$k);
			}
			// Nothing to set publishing state on, return false.
			else {
				$this->setError(JText::_('JLIB_DATABASE_ERROR_NO_ROWS_SELECTED'));
				return false;
			}
		}

		// Build the WHERE clause for the primary keys.
		$where = $k.'='.implode(' OR '.$k.'=', $pks);


		// Update the publishing state for rows with the given primary keys.
		$this->_db->setQuery(
			'UPDATE #__farm' .
			' SET '.$this->_db->quoteName('status').' = '.(int) $state .
			' WHERE (id) =' . $id
			 );
		$this->_db->query();

		// Check for a database error.
		if ($this->_db->getErrorNum()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
   // this below line for the seeting the current status may be (status is the for publish/unpublish field..)
        $this->status = $state;
		$this->setError('');
		return true;
	}

/**
	 * Method to delete record(s)
	 *
	 * @access    public
	 * @return    boolean    True on success
	 */
		function delete()
		{
		    $cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
		    $row =& $this->getTable('farm','farmappTable');
		  //  var_dump($cids); die;
		    foreach($cids as $cid) {
		  		if (!$row->delete( $cid )) {
		  			 $this->setError( $row->getErrorMsg() );
		            return false;
		        }
		    }
		 
		    return true;
		}
/**
	 * Method to publish record(s)
	 *
	 * @access    public
	 * @return    boolean    True on success
	 */
		function multiplepublish()
		{
		    $cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
		    $db =& JFactory::getDBO();
		    $row =& $this->getTable('farm','farmappTable');
		    foreach($cids as $cid) {
				$query = 'UPDATE #__farm SET status = 1'.
                		 '  WHERE id = '.$cid; 
                $db->setQuery($query);
                $db->query();
		     }
			 return true;
		}

		/**
	 * Method to unpublish record(s)
	 *
	 * @access    public
	 * @return    boolean    True on success
	 */
		function multipleunpublish()
		{
		    $cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
		    $db =& JFactory::getDBO();
		    $row =& $this->getTable('farm','farmappTable');
		    foreach($cids as $cid) {
				$query = 'UPDATE #__farm SET status = 0'.
                		 '  WHERE id = '.$cid; 
                $db->setQuery($query);
                $db->query();
		     }
			 return true;
		}	
}