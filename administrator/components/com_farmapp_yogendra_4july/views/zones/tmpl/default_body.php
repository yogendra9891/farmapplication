<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
$user	= JFactory::getUser();
$userId	= $user->get('id');

			 $k = 0;
			  for ($i=0, $n=count( $this->items ); $i < $n; $i++)
   				 {
			  $row =& $this->items[$i];
	    	  $checked = JHTML::_('grid.id', $i, $row->id );
	        $link = JRoute::_( 'index.php?option=com_farmapp&view=zones&task=edit&cid[]='. (int)$row->id );

			$ordering	= ($this->state->get('list.ordering') == 'a.ordering');
			$canCreate	= $user->authorise('core.create',		'com_farmapp');
			$canEdit	= $user->authorise('core.edit',			'com_farmapp');
			$canCheckin	= $user->authorise('core.manage',		'com_farmapp');
			$canChange	= $user->authorise('core.edit.status',	'com_farmapp');
			?>
	<tr class="row<?php echo $i % 2; ?>">
		<td>
			<?php echo $checked;?>
		</td>
		<td>
		 <?php if (isset($row->name)) { ?>
			<a href="<?php echo $link; ?>"><?php echo $row->name; ?></a>
		<?php } ?> 
		</td>
		<td>
		 <?php if (isset($row->status)) { ?>
			 <?php echo JHtml::_('jgrid.published', $row->status, $i, '', $canChange, 'cb'); ?>
		 <?php } ?> 
		</td>
				<td>
		<?php if (isset($row->farm)) { ?>
			<a href="<?php echo $link; ?>"><?php echo $row->farm; ?></a>
		<?php } ?> 
		</td>
		<td>
		<?php if (isset($row->description)) { ?>
			<a href="<?php echo $link; ?>"><?php echo $row->description; ?></a>
		<?php } ?> 
		</td>
		<td>
		<?php if (isset($row->id)) { ?>
			<a href="<?php echo $link; ?>"><?php echo $row->id; ?></a>
		<?php } ?> 
		</td>
	</tr>
<?php
 		$k = 1 - $k; 
		} ?> 
