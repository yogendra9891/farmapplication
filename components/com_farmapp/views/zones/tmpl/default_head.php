<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');

?>

<tr>
				<th width="1%">
					<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($this->items); ?>);" />
				</th>	
				
				<th width="20%" style="text-align:left;">
				<?php echo JHtml::_('grid.sort', 'NAME', 'a.name', $this->state->get('list.direction'),$this->state->get('list.ordering') ); ?>
				</th>
				
	 
				<th width="20%" style="text-align:left; color: #025A8D;">
					<?php echo JText::_( 'Status' ); ?>
				</th>
                
               
				<th width="59%" style="text-align:left; color: #025A8D;">
					<?php echo JText::_('Decription' ); ?>
				</th>
 
                
		
	
</tr>
