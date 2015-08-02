<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');

?>

<tr>
				<th width="20">
					<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($this->items); ?>);" />
				</th>	
				
				<th style="text-align:left;">
				<?php echo JHtml::_('grid.sort', 'NAME', 'b.name', $this->state->get('list.direction'),$this->state->get('list.ordering')); ?>
				</th>
				
	 
				<th width="20%" style="text-align:left;">
					<?php echo JText::_( 'Status' ); ?>
				</th>
				
  				<th width="20%" style="text-align:left;">
					<?php echo JText::_( 'Unit Cost' ); ?>
				</th>              
                
				<th width="20%" style="text-align:left;">
					<?php echo JText::_('Decription' ); ?>
				</th>
 
                <th width="5">
				<?php echo JHtml::_('grid.sort', 'ID', 'b.id', $this->state->get('list.direction'),$this->state->get('list.ordering')); ?>
				</th>	
                
		
	
</tr>
