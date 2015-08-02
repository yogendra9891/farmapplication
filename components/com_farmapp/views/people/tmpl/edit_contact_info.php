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
$fieldSets = $this->form->getFieldsets('contact_info');
?>
<div class="blueheading">
<?php
echo JText::_('Contact Infromation');
?>
</div>

<fieldset class="panelform fieldsetborder">
		<ul class="adminformlist keywords-tags spacelabel">
		
			<li><?php echo $this->form->getLabel('telephone'); ?>
				<?php echo $this->form->getInput('telephone','',@$this->item->telephone); ?></li>
			<li><?php echo $this->form->getLabel('mobile'); ?>
				<?php echo $this->form->getInput('mobile','',@$this->item->mobile); ?></li>
			<li><?php echo $this->form->getLabel('address'); ?>
				<?php echo $this->form->getInput('address','',@$this->item->address); ?></li>
			<li><?php echo $this->form->getLabel('email'); ?>
				<?php echo $this->form->getInput('email','',@$this->item->email); ?></li>
			
		</ul>
</fieldset>
