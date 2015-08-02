<?php 
//var_dump($this->form->getField('description')); 
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
// Load the tooltip behavior.
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
//var_dump($this->item);die;
?>
<form action="<?php echo JRoute::_('index.php?option=com_farmapp&view=beds'); ?>" method="post" name="adminForm" id="farm-form" class="form-validate">
	<div class="width-60 fltlft">
		<fieldset class="adminform">
			<legend><?php echo empty($this->item->id) ? JText::_('COM_FARMAPP_NEW_ZONE') : JText::sprintf('COM_FARMAPP_EDIT_ZONE', $this->item->id); ?></legend>
			<ul class="adminformlist">
				<li><?php echo $this->form->getLabel('name'); ?>
				<?php echo $this->form->getInput('name','',$this->item->name); ?></li>

				<li><?php echo $this->form->getLabel('description'); ?>
				<?php echo $this->form->getInput('description','',$this->item->description); ?></li>
				
				<li><?php echo $this->form->getLabel('farmzone'); ?>
				<?php echo $this->form->getInput('farmzone','',$this->item->farmzone); ?></li>

				<li><?php echo $this->form->getLabel('totalarea'); ?>
				<?php echo $this->form->getInput('totalarea','',$this->item->totalarea); ?></li>

				<li><?php echo $this->form->getLabel('notes'); ?>
				<?php echo $this->form->getInput('notes','',$this->item->notes); ?></li>

							<li><?php echo $this->form->getLabel('status'); ?>
				<?php echo $this->form->getInput('status','',$this->item->status); ?></li>
				
				<li><?php echo $this->form->getLabel('language'); ?>
				<?php echo $this->form->getInput('language','',$this->item->language); ?></li>
				

				<li><?php echo $this->form->getLabel('id'); ?>
				<?php echo $this->form->getInput('id','',$this->item->id); ?></li>
			</ul>

		</fieldset>
	</div>

	<div class="width-40 fltrt">
		<?php echo JHtml::_('sliders.start', 'farm-sliders-'.@$this->item->id, array('useCookie'=>1)); ?>

		<?php echo $this->loadTemplate('params'); ?>

		<?php echo JHtml::_('sliders.end'); ?>

		<input type="hidden" name="task" value="" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
	<div class="clr"></div>
</form>