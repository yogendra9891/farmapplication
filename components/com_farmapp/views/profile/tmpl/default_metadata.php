<?php
/**
 * @package		Joomla.Administrator
 * @subpackage	com_weblinks
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

$fieldSets = $this->form->getFieldsets('keywords_tags');
?>
 <div class="blueheading">
<?php
echo  JText::_('keywords tags');
?>
</div>


		<ul class="adminformlist keywords-tags">
		
			<li><?php echo $this->form->getLabel('html_meta_tags','keywords_tags'); ?>
				<?php echo $this->form->getInput('html_meta_tags','keywords_tags',@$this->item->keywords_tags['html_meta_tags']); ?></li>
			<li><?php echo $this->form->getLabel('specialities','keywords_tags'); ?>
				<?php echo $this->form->getInput('specialities','keywords_tags',@$this->item->keywords_tags['specialities']); ?></li>

		</ul>


