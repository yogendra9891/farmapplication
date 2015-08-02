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
	        $link = JRoute::_( 'index.php?option=com_farmapp&view=activities&task=edit&cid[]='. (int)$row->id );

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
			<?php if ($canEdit) : ?>
			<a href="<?php echo $link; ?>"><?php echo $row->name; ?></a>
			<?php else : ?>
						<?php echo $row->name; ?>
					<?php endif; ?>
		<?php } ?> 
		</td>
		<td>
		 <?php if (isset($row->status)) { ?>
			 <?php echo JHtml::_('jgrid.published', $row->status, $i, '', $canChange, 'cb'); ?>
		 <?php } ?> 
		</td>
		<td>
		 <?php if (isset($row->activity_status)) { ?>
			<?php if ($canEdit) : ?>
			<a href="<?php echo $link; ?>"><?php echo $row->activity_status; ?></a>
			<?php else : ?>
						<?php echo $row->activity_status; ?>
					<?php endif; ?>
		<?php } ?> 

		</td>

		<td>
		<?php if (isset($row->date_of_activity)) { ?>
		<?php if ($canEdit) : ?>
			<a href="<?php echo $link; ?>"><?php echo date('F d, Y', strtotime($row->date_of_activity)); ?></a>
			<?php else : ?>
						<?php echo date('F d, Y', strtotime($row->date_of_activity)); ?>
					<?php endif; ?>
		<?php } ?> 
		</td>
		<td>
		<?php if (isset($row->location)) { ?>
		<?php if ($canEdit) : ?>
			<a href="<?php echo $link; ?>"><?php echo $row->location; ?></a>
			<?php else : ?>
						<?php echo $row->location; ?>
					<?php endif; ?>
		<?php } ?> 
		</td>

		<td>
		<?php if (isset($row->activity_mode)) { ?>
		<?php if ($canEdit) : ?>
			<a href="<?php echo $link; ?>"><?php echo $row->activity_mode; ?></a>
			<?php else : ?>
						<?php echo $row->activity_mode; ?>
					<?php endif; ?>
		<?php } ?> 
		</td>

		<td>
		<?php if (isset($row->id)) { ?>
		<?php if ($canEdit) : ?>
			<a href="<?php echo $link; ?>"><?php echo $row->id; ?></a>
			<?php else : ?>
						<?php echo $row->id; ?>
					<?php endif; ?>
		<?php } ?> 
		</td>
	</tr>
<?php
 		$k = 1 - $k; 
		} ?> 