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
echo JHtml::_('sliders.panel', JText::_('keywords tags'), 'keywords_tags');

?>
	<fieldset class="panelform">
		<ul class="adminformlist">
		
			<li><?php echo $this->form->getLabel('html_meta_tags','keywords_tags'); ?>
				<?php echo $this->form->getInput('html_meta_tags','keywords_tags',@$this->item->keywords_tags['html_meta_tags']); ?></li>
			<li><?php echo $this->form->getLabel('specialities','keywords_tags'); ?>
				<?php echo $this->form->getInput('specialities','keywords_tags',@$this->item->keywords_tags['specialities']); ?></li>

		</ul>
	</fieldset>

