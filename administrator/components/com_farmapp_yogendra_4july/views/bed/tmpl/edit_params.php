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
$fieldSets = $this->form->getFieldsets('options');
foreach ($fieldSets as $name => $fieldSet) :
	echo JHtml::_('sliders.panel', JText::_($fieldSet->label), $name.'-options');
	if (isset($fieldSet->options) && trim($fieldSet->options)) :
		echo '<p class="tip">'.$this->escape(JText::_($fieldSet->options)).'</p>';
	endif;
	?>
	<fieldset class="panelform">
		<ul class="adminformlist">
			<?php if ($name == 'joptions') : // Include the real fields in this panel. ?>
			<?php echo JText::_('No other obtions available');?>
							<?php endif; ?>
			<?php foreach ($this->form->getFieldset($name) as $field) : ?>
				<li><?php echo $field->label; ?>
				<?php echo $field->input; ?></li>
			<?php endforeach; ?>
		</ul>
	</fieldset>
<?php endforeach; ?>
