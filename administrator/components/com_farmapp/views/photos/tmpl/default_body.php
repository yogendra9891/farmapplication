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
	        $link = JRoute::_( 'index.php?option=com_farmapp&view=photos&task=edit&cid[]='. (int)$row->id );

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
		<?php if (isset($row->farm)) { ?>
		<?php if ($canEdit) : ?>
			<a href="<?php echo $link; ?>"><?php echo $row->farm; ?></a>
			<?php else : ?>
						<?php echo $row->farm; ?>
					<?php endif; ?>
		<?php } ?> 
		</td>
		<td>
		<?php if (isset($row->description)) { ?>
		<?php if ($canEdit) : ?>
			<a href="<?php echo $link; ?>"><?php echo substr($row->description,0,25)."...."; ?></a>
			<?php else : ?>
						<?php echo substr($row->description,0,25)."...."; ?>
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