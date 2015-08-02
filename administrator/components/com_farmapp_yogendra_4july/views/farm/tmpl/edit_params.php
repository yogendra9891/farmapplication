<?php
/**
 * @package		Joomla.Administrator
 * @subpackage	com_weblinks
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;
//$social_media_links = json_decode($this->item->social_media_links);
$fieldSets = $this->form->getFieldsets('social_media_links');
foreach ($fieldSets as $name => $fieldSet) :
	echo JHtml::_('sliders.panel', JText::_($fieldSet->label), $name.'-social_media_links');
	if (isset($fieldSet->social_media_links) && trim($fieldSet->social_media_links)) :
		echo '<p class="tip">'.$this->escape(JText::_($fieldSet->social_media_links)).'</p>';
	endif;
	?>
	<fieldset class="panelform">
		<ul class="adminformlist">
			<?php if ($name == 'jsocial_media_links') : // Include the real fields in this panel. ?>
				<li><?php echo $this->form->getLabel('Facebook Link'); ?>
				<?php echo $this->form->getInput('facebook'); ?></li>

				<li><?php echo $this->form->getLabel('Twitter'); ?>
				<?php echo $this->form->getInput('twitter'); ?></li>

				<li><?php echo $this->form->getLabel('Linked In'); ?>
				<?php echo $this->form->getInput('linkedin'); ?></li>

			<?php endif; ?>
			<?php foreach ($this->form->getFieldset($name) as $field) : ?>
				<li><?php echo $field->label; ?>
				<?php echo $field->input; ?></li>
			<?php endforeach; ?>
		</ul>
	</fieldset>
<?php endforeach; ?>
