<?php
//echo "sdcc"; exit;
/**
 * @version     1.0.0
 * @package     com_farmapp
 * @copyright   Copyright (C) 2012. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Created by com_combuilder - http://www.notwebdesign.com
 */

// no direct access
defined('_JEXEC') or die;
//$userId = JFactory::getUser()->id;
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
//JHtml::_(‘script’, ‘joomla.javascript.js’, ‘includes/js/’);
$filename = 'joomla.javascript.js';
$path = 'includes/js/';
JHTML::script($filename, $path);
//var_dump($this->item); die;	
// Load the tooltip behavior.
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
?>
<form action="<?php echo JRoute::_('index.php?option=com_farmapp&view=profile'); ?>" method="post" id="farm-form" name="adminForm">
  <div class="customcsstoolbar">
	<?php echo $this->getToolbar(); ?>
 </div>
	<div class="width-60 fltlft">
		<fieldset class="adminform fieldsetborder">
			<legend><?php echo empty($this->item->id) ? JText::_('COM_FARMAPP_NEW_FARM') : JText::sprintf('COM_FARMAPP_EDIT_FARM', $this->item->id); ?></legend>
			<ul class="adminformlist">
				<li><?php echo $this->form->getLabel('name'); ?>
				<?php echo $this->form->getInput('name','',$this->item->name); ?></li>

				<li><?php echo $this->form->getLabel('street1'); ?>
				<?php echo $this->form->getInput('street1','',$this->item->street1); ?></li>

				<li><?php echo $this->form->getLabel('street2'); ?>
				<?php echo $this->form->getInput('street2','',$this->item->street2); ?></li>

				<li><?php echo $this->form->getLabel('city'); ?>
				<?php echo $this->form->getInput('city','',$this->item->city); ?></li>

				<li><?php echo $this->form->getLabel('state'); ?>
				<?php echo $this->form->getInput('state','',$this->item->state); ?></li>

				<li><?php echo $this->form->getLabel('postal_code'); ?>
				<?php echo $this->form->getInput('postal_code','',$this->item->postal_code); ?></li>

				<li><?php echo $this->form->getLabel('telephone'); ?>
				<?php echo $this->form->getInput('telephone','',$this->item->telephone); ?></li>

				<li><?php echo $this->form->getLabel('email_address'); ?>
				<?php echo $this->form->getInput('email_address','',$this->item->email_address); ?></li>
				
				<li><?php echo $this->form->getLabel('website_url'); ?>
				<?php echo $this->form->getInput('website_url','',$this->item->website_url); ?></li>

				<li><?php echo $this->form->getLabel('hours_of_operation'); ?>
				<?php echo $this->form->getInput('hours_of_operation','',$this->item->hours_of_operation); ?></li>
				
				<li><?php echo $this->form->getLabel('status'); ?>
				<?php echo $this->form->getInput('status','',$this->item->status); ?></li>
				
				<li><?php echo $this->form->getLabel('language'); ?>
				<?php echo $this->form->getInput('language','',$this->item->language); ?></li>
				

				<li><?php echo $this->form->getLabel('id'); ?>
				<?php echo $this->form->getInput('id','',$this->item->id); ?></li>
			</ul>
			<?php echo $this->loadTemplate('params'); ?>
          
		</fieldset>
	</div>

	<div class="width-40 fltrt">
		<?php //echo JHtml::_('sliders.start', 'farm-sliders-'.$this->item->id, array('useCookie'=>1)); ?>
      <div class="blueheading">
        <?php echo  JText::_('Farm Description'); ?>
        </div>
		<fieldset class="panelform fieldsetborder">
			<ul class="adminformlist">
				<li><?php echo $this->form->getLabel('description'); ?>
				<?php echo $this->form->getInput('description','',$this->item->description); ?></li>

				<li><?php echo $this->form->getLabel('history'); ?>
				<?php echo $this->form->getInput('history','',$this->item->history); ?></li>

				<li><?php echo $this->form->getLabel('date_founded'); ?>
				<?php echo $this->form->getInput('date_founded','',$this->item->date_founded); ?></li>

			</ul>
		</fieldset>
     <?php  echo $this->loadTemplate('metadata'); ?>
		

		

		<?php echo JHtml::_('sliders.end'); ?>
        
		<input type="hidden" name="task" value="" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
	<div class="clr"></div>
</form>