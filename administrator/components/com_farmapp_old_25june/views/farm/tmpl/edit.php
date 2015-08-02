<?php
/**
 * @package		Joomla.Administrator
 * @subpackage	com_farmapp
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
//echo "test"; exit;
//var_dump($this->items); die;
// no direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
?>

<form action="<?php echo JRoute::_('index.php?option=com_farmapp&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="farm-form" class="form-validate">
	<div class="width-60 fltlft">
		<fieldset class="adminform">
			<legend><?php echo empty($this->item->id) ? JText::_('COM_FARMAPP_NEW_FARM') : JText::sprintf('COM_FARMAPP_EDIT_FARM', $this->item->id); ?></legend>
			<ul class="adminformlist">
				<li><?php echo $this->form->getLabel('name'); ?>
				<?php echo $this->form->getInput('name'); ?></li>

				<li><?php echo $this->form->getLabel('street1'); ?>
				<?php echo $this->form->getInput('street1'); ?></li>

				<li><?php echo $this->form->getLabel('street2'); ?>
				<?php echo $this->form->getInput('street2'); ?></li>

				<li><?php echo $this->form->getLabel('city'); ?>
				<?php echo $this->form->getInput('city'); ?></li>

				<li><?php echo $this->form->getLabel('state'); ?>
				<?php echo $this->form->getInput('state'); ?></li>

				<li><?php echo $this->form->getLabel('postal_code'); ?>
				<?php echo $this->form->getInput('postal_code'); ?></li>

				<li><?php echo $this->form->getLabel('telephone'); ?>
				<?php echo $this->form->getInput('telephone'); ?></li>

				<li><?php echo $this->form->getLabel('email_address'); ?>
				<?php echo $this->form->getInput('email_address'); ?></li>
				
				<li><?php echo $this->form->getLabel('website_url'); ?>
				<?php echo $this->form->getInput('website_url'); ?></li>

				<li><?php echo $this->form->getLabel('hours_of_operation'); ?>
				<?php echo $this->form->getInput('hours_of_operation'); ?></li>
				
				<li><?php echo $this->form->getLabel('status'); ?>
				<?php echo $this->form->getInput('status'); ?></li>
				
				<li><?php echo $this->form->getLabel('language'); ?>
				<?php echo $this->form->getInput('language'); ?></li>
				
				

				<li><?php echo $this->form->getLabel('id'); ?>
				<?php echo $this->form->getInput('id'); ?></li>
			</ul>

		</fieldset>
	</div>

	<div class="width-40 fltrt">
		<?php echo JHtml::_('sliders.start', 'farm-sliders-'.$this->item->id, array('useCookie'=>1)); ?>
        <?php echo JHtml::_('sliders.panel', JText::_('Farm Description'), 'farm-options'); ?>
		<fieldset class="panelform">
			<ul class="adminformlist">
				<li><?php echo $this->form->getLabel('description'); ?>
				<?php echo $this->form->getInput('description'); ?></li>

				<li><?php echo $this->form->getLabel('history'); ?>
				<?php echo $this->form->getInput('history'); ?></li>

				<li><?php echo $this->form->getLabel('date_founded'); ?>
				<?php echo $this->form->getInput('date_founded'); ?></li>

			</ul>
		</fieldset>

		<?php echo $this->loadTemplate('keywords_tags'); ?>

		<?php echo $this->loadTemplate('social_media_links'); ?>

         
		<?php echo JHtml::_('sliders.end'); ?>

		<input type="hidden" name="task" value="" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
	<div class="clr"></div>
</form>