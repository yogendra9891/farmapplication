<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
// import the Joomla modellist library
jimport('joomla.application.component.modellist');
/**
 * HelloWorldList Model
 */
class FarmAppModelFarmApp extends JModelList
{
	
	public function populateState() {
		
		// If the context is set, assume that stateful lists are used.
		if ($this->context)
		{
			$app = JFactory::getApplication();

			$value = $app->getUserStateFromRequest('global.list.limit', 'limit', $app->getCfg('list_limit'));
			$limit = $value;
			$this->setState('list.limit', $limit);

			$value = $app->getUserStateFromRequest($this->context . '.limitstart', 'limitstart', 0);
			$limitstart = ($limit != 0 ? (floor($value / $limit) * $limit) : 0);
			$this->setState('list.start', $limitstart);
	
				// Load the filter state.
			$search = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
			$this->setState('filter.search', $search);
			
				// Load the custom filter farm state.
			$farm = $this->getUserStateFromRequest($this->context.'.filter.farm_id', 'filter_farm_id');
			$this->setState('filter.farm_id', $farm);
			
			// Load the custom filter farm state.
			$zone = $this->getUserStateFromRequest($this->context.'.filter.zone_id', 'filter_zone_id');
			$this->setState('filter.zone_id', $zone);
					
			$filter_order = JRequest::getCmd('filter_order','id');
			$filter_order_Dir = JRequest::getCmd('filter_order_Dir');
		 
			$this->setState('list.ordering', $filter_order);
			$this->setState('list.direction', $filter_order_Dir);
			
			
		}
		else
		{
			$this->setState('list.start', 0);
			$this->state->set('list.limit', 0);
		}
	}
	
	
	
	
		
}