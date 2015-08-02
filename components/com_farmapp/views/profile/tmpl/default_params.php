<?php
/**
 * @package		Joomla.Administrator
 * @subpackage	com_weblinks
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;?>
<ul class="adminformlist medialinks">
<?php echo  JText::_('Social Media Links'); ?>

</ul>
		<ul class="adminformlist">
		
			<li><?php echo $this->form->getLabel('facebook','social_media_links'); ?>
				<?php echo $this->form->getInput('facebook','social_media_links',@$this->item->social_media_links['facebook']); ?></li>
			<li><?php echo $this->form->getLabel('twitter','social_media_links'); ?>
				<?php echo $this->form->getInput('twitter','social_media_links',@$this->item->social_media_links['twitter']); ?></li>
			<li><?php echo $this->form->getLabel('linkedin','social_media_links'); ?>
				<?php echo $this->form->getInput('linkedin','social_media_links',@$this->item->social_media_links['linkedin']); ?></li>
			
		</ul>

