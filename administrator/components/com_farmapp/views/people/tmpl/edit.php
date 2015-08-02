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

?>
<form action="<?php echo JRoute::_('index.php?option=com_farmapp&view=peoples'); ?>" method="post" name="adminForm" id="farm-form" class="form-validate">
	<div class="width-60 fltlft">
		<fieldset class="adminform">
			<legend><?php echo empty($this->item->id) ? JText::_('COM_FARMAPP_NEW_PERSON') : JText::sprintf('COM_FARMAPP_EDIT_PERSON', $this->item->id); ?></legend>
			<ul class="adminformlist">
				<li><?php echo $this->form->getLabel('name'); ?>
				<?php echo $this->form->getInput('name','',@$this->item->name); ?></li>

				<li><?php echo $this->form->getLabel('title'); ?>
				<?php echo $this->form->getInput('title','',@$this->item->title); ?></li>
				
				<li><?php echo $this->form->getLabel('labor_category'); ?>
				<?php echo $this->form->getInput('labor_category','',@$this->item->labor_category); ?></li>
				
				<li><?php echo $this->form->getLabel('farm'); ?>
				<?php echo $this->form->getInput('farm','',@$this->item->farm); ?></li>
				
				<li><?php echo $this->form->getLabel('employee_since'); ?>
				<?php echo $this->form->getInput('employee_since','',@$this->item->employee_since); ?></li>
				
				<li><?php echo $this->form->getLabel('notes'); ?>
				<?php echo $this->form->getInput('notes','',@$this->item->notes); ?></li>

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
		<?php echo JHtml::_('sliders.start', 'people-sliders-'.$this->item->id, array('useCookie'=>1)); ?>
       <?php echo $this->loadTemplate('contact_info'); ?>

		<?php echo $this->loadTemplate('biography'); ?>

		<?php echo JHtml::_('sliders.end'); ?>

		<input type="hidden" name="task" value="" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
	<div class="clr"></div>
</form>
<script language="javascript">
Joomla.submitbutton = function(task)
{
	if (task == 'cancel' || document.formvalidator.isValid(document.id('farm-form'))) {
		<?php //echo $this->form->getField('misc')->save(); ?>
		Joomla.submitform(task, document.getElementById('farm-form'));
	}
	else {
		alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'));?>');
	}

}

</script>