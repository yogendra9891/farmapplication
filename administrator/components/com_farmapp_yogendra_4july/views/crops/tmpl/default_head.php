<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');

?>

<tr>
				<th width="20">
					<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($this->items); ?>);" />
				</th>	
				
				<th>
				<?php echo JHtml::_('grid.sort', 'Name', 'a.name', $this->state->get('list.direction'),$this->state->get('list.ordering') ); ?>
				</th>
				
	 
				<th width="5%">
					<?php echo JText::_( 'Status' ); ?>
				</th>
                
                
				<th width="5%">
					<?php echo JText::_('Description' ); ?>
				</th>
                
                
                
				<th width="5%">
					<?php echo JText::_( 'Location(s)')?>
				</th>
        		

                
                <th width="5">
				<?php echo JHtml::_('grid.sort', 'ID', 'a.id', $this->state->get('list.direction'),$this->state->get('list.ordering')); ?>
				</th>	
                
		
	
</tr>
