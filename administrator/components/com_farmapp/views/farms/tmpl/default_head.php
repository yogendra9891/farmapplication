<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');

?>

<tr style="text-align:left;">
				<th width="20">
					<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($this->items); ?>);" />
				</th>	
				
				<th  width="15%">
				<?php echo JHtml::_('grid.sort', 'NAME', 'a.name', $this->state->get('list.direction'),$this->state->get('list.ordering') ); ?>
				</th>
				
	 
				<th width="5%">
					<?php echo JText::_( 'Status' ); ?>
				</th>
                
                
				<th width="5%">
					<?php echo JText::_('Telephone' ); ?>
				</th>
                
                
                
				<th>
					<?php echo JText::_( 'Address')?>
				</th>
        		

                
                <th width="5">
				<?php echo JHtml::_('grid.sort', 'ID', 'a.id', $this->state->get('list.direction'),$this->state->get('list.ordering')); ?>
				</th>	
                
		
	
</tr>
