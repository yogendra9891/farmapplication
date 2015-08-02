<?php 

/**
 * @package		Joomla.Administrator
 * @subpackage	com_farmapp
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
//var_dump(JPATH_COMPONENT); die;	
// Load the tooltip behavior.
JHtml::_('behavior.mootools');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');

//var_dump($this->item);die;
?>

<form action="<?php echo JRoute::_('index.php?option=com_farmapp&view=crops'); ?>" method="post" name="adminForm" id="farm-form" class="form-validate">
	<div class="width-60 fltlft">
		<fieldset class="adminform">
			<legend><?php echo empty($this->item->id) ? JText::_('COM_FARMAPP_NEW_CROP') : JText::sprintf('COM_FARMAPP_EDIT_CROP', $this->item->id); ?></legend>
			<ul class="adminformlist">
				<li><?php echo $this->form->getLabel('name'); ?>
				<?php echo $this->form->getInput('name','',$this->item->name); ?></li>

				<li><?php echo $this->form->getLabel('description'); ?>
				<?php echo $this->form->getInput('description','',$this->item->description); ?></li>


				<li><?php echo $this->form->getLabel('farmzonecrop'); ?>
				<?php echo $this->form->getInput('farmzonecrop','',$this->item->farmzonecrop); ?></li>

                <li><div id="bed_id"><?php echo $this->form->getLabel('bed_id');?>
                
               <?php echo $this->form->getInput('bed_id','',$this->item->bed_id); ?>
             
                </div>
                </li>

				<li><?php echo $this->form->getLabel('plant_variety_id'); ?>
				<?php echo $this->form->getInput('plant_variety_id','',$this->item->plant_variety_id); ?></li>
				
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
		<?php echo JHtml::_('sliders.start', 'crop-sliders-'.$this->item->id, array('useCookie'=>1)); ?>
        <?php echo JHtml::_('sliders.panel', JText::_('Income'), 'farm-options'); ?>
		<fieldset class="panelform">
			<ul class="adminformlist">
				<li><?php echo $this->form->getLabel('quantity'); ?>
				<?php echo $this->form->getInput('quantity','',$this->item->quantity); ?></li>

				<li><?php echo $this->form->getLabel('unit'); ?>
				<?php echo $this->form->getInput('unit','',$this->item->unit); ?></li>

				<li><?php echo $this->form->getLabel('total_income'); ?>
				<?php echo $this->form->getInput('total_income','',$this->item->total_income); ?></li>

			</ul>
		</fieldset>
		
		<?php echo $this->loadTemplate('params'); ?>		

		<?php echo JHtml::_('sliders.end'); ?>

		<input type="hidden" name="task" value="" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
	<div class="clr"></div>
	
</form>
<script language="javascript">
window.addEvent('domready', function() { //alert('kk');
    $('farmzonecrop').addEvent('change', function(e) {
    //	$('bedid').empty();
    	e.stop(); 
    	var val=document.getElementById('farmzonecrop').value;
    	var id =document.getElementById('id').value;
    	var myElement = document.getElementById('bed_id');
      	var url = 'index.php?option=com_farmapp&view=crops&task=findbeds&format=raw&val='+val+'&cropid='+id;
        var x = new Request({
            url: url,
            method: 'GET',
            onSuccess: function(responseText){ 
        	myElement.set('html', responseText);
        }
            }).send();
        });
        
    });
window.addEvent('load', function() {
	//function is calling for getting the all the beds, is defined in js (function.js)
	var id=document.getElementById('id').value;
	onloadbed(id);
});

</script>
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
	if(task != 'cancel' || document.formvalidator.isValid(document.id('farm-form')))
	{
		
	}
}

</script>