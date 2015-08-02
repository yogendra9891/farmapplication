<?php
/**
 * @package		Joomla.Administrator
 * @subpackage	com_weblinks
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

$fieldSets = $this->form->getFieldsets('biography');
?>
<ul class="adminformlist medialinks">
<?php 
echo JText::_('Biography');
?>
</ul>


		<ul class="adminformlist forfileds pictureimagess">
		
			<li><?php echo $this->form->getLabel('bio'); ?>
				<?php echo $this->form->getInput('bio','',@$this->item->bio); ?></li>
			<li class="selectimageclass"><?php echo $this->form->getLabel('picture'); ?>
				<?php echo $this->form->getInput('picture','',@$this->item->picture); ?></li>

		</ul>


