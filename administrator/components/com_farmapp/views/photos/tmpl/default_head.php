<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');

?>

<tr>
				<th width="20">
					<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($this->items); ?>);" />
				</th>	
				
				<th style="text-align:left;">
				<?php echo JHtml::_('grid.sort', 'NAME', 'a.name', $this->state->get('list.direction'),$this->state->get('list.ordering') ); ?>
				</th>
	
				<th width="20%" style="text-align:left;">
					<?php echo JText::_( 'Status' ); ?>
				</th>
    
    			<th width="20%" style="text-align:left;">
					<?php echo JText::_( 'Farms' ); ?>
				</th>            
                
				<th width="20%" style="text-align:left;">
					<?php echo JText::_('Decription' ); ?>
				</th>
 
                <th width="5">
				<?php echo JHtml::_('grid.sort', 'ID', 'a.id', $this->state->get('list.direction'),$this->state->get('list.ordering')); ?>
				</th>	
                
		
	
</tr>
