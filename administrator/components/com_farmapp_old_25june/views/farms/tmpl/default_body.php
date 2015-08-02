<?php
defined('_JEXEC') or die('Restricted access');
?>
<!-- Deafult administrator message -->
<form action="index.php" method="post" name="adminForm" id="adminForm">

	<table>
<tr>
	<td align="left" width="100%">
		<?php echo JText::_( 'Filter' ); ?>:
		<input type="text" name="search" id="search" value="<?php echo htmlspecialchars($this->lists['search']);?>" class="text_area" onchange="document.adminForm.submit();" />
		<button onclick="this.form.submit();"><?php echo JText::_( 'Go' ); ?></button>
		<button onclick="document.getElementById('search').value='';this.form.submit();"><?php echo JText::_( 'Reset' ); ?></button>
	</td>
</tr>
</table>
	<table class="adminlist">
			<thead>
				<tr>
					<th width="20">
						<?php echo JText::_( 'Num' ); ?>
					</th>
					<th width="20">
						<input type="checkbox" name="toggle" value=""  onclick="checkAll(<?php echo count( $this->items ); ?>);" />
					</th>
					<th width="1%" nowrap="nowrap">
						<?php echo JHTML::_('grid.sort', 'Id', 'tbl.id', @$this->lists['order_Dir'], @$this->lists['order'] );?>
					</th>
					<th nowrap="nowrap" class="title">
						<?php echo JHTML::_('grid.sort', 'Name', 'tbl.name', @$this->lists['order_Dir'], @$this->lists['order'] ); ?>
					</th>
				</tr>
			</thead>
			<?php
			 $k = 0;
			  for ($i=0, $n=count( $this->items ); $i < $n; $i++)
   				 {
			  $row =& $this->items[$i];
	    	  $checked = JHTML::_('grid.id', $i, $row->id );
	        $link = JRoute::_( 'index.php?option=com_farm&view=farms&task=edit&cid[]='. $row->id );
			?>
			<tr class="<?php echo "row$k"; ?>">
            <td>
                 <?php echo $this->pagination->getRowOffset( $i ); ?>
            </td>
           
            <td>
              <?php echo $checked; ?>
            </td>
            <td>
              <?php echo $row->id; ?>
            </td>
            <td>
                <a href="<?php echo $link; ?>"><?php echo $row->title; ?></a>
            </td>
        </tr>
        <?php $k = 1 - $k; 
			 } ?>
        <tr><td colspan="5"><?php echo $this->pagination->getListFooter(); ?></td></tr>
			</table>
 
<input type="hidden" name="option" value="com_farm" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="view" value="farms" />
<input type="hidden" name="filter_order" value="<?php echo  $this->lists['order']; ?>" />
<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />

</form>