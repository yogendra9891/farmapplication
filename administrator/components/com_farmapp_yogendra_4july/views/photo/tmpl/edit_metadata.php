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
foreach ($fieldSets as $name => $fieldSet) :
	echo JHtml::_('sliders.panel', JText::_($fieldSet->label), $name.'-keywords_tags');
	if (isset($fieldSet->description) && trim($fieldSet->description)) :
		echo '<p class="tip">'.$this->escape(JText::_($fieldSet->description)).'</p>';
	endif;
	?>
	<fieldset class="panelform">
		<ul class="adminformlist">
			<?php if ($name == 'Jkeywords_tags') : // Include the real fields in this panel. ?>
				<li><?php echo $this->form->getLabel('HTML Meta Tags'); ?>
				<?php echo $this->form->getInput('html_meta_tag'); ?></li>

				<li><?php echo $this->form->getLabel('Specialities'); ?>
				<?php echo $this->form->getInput('specialities'); ?></li>

			<?php endif; ?>
			<?php foreach ($this->form->getFieldset($name) as $field) : ?>
				<li><?php echo $field->label; ?>
				<?php echo $field->input; ?></li>
			<?php endforeach; ?>
		</ul>
	</fieldset>
<?php endforeach; ?>
