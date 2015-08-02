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
<form action="<?php echo JRoute::_('index.php?option=com_farmapp&view=activities'); ?>" method="post" name="adminForm" id="farm-form" class="form-validate">
	<div class="width-60 fltlft">
		<fieldset class="adminform">
			<legend><?php echo empty($this->item->id) ? JText::_('COM_FARMAPP_NEW_ACTIVITY') : JText::sprintf('COM_FARMAPP_EDIT_ACTIVITY', $this->item->id); ?></legend>
			<ul class="adminformlist">
				<li><?php echo $this->form->getLabel('name'); ?>
				<?php echo $this->form->getInput('name','',$this->item->name); ?></li>

				<li><?php echo $this->form->getLabel('description'); ?>
				<?php echo $this->form->getInput('description','',$this->item->description); ?></li>
				
				<li><?php echo $this->form->getLabel('date_of_activity'); ?>
				<?php echo $this->form->getInput('date_of_activity','',$this->item->date_of_activity); ?></li>

				<li><?php echo $this->form->getLabel('duration'); ?>
				<?php echo $this->form->getInput('duration','',$this->item->duration); ?></li>

				<li><?php echo $this->form->getLabel('farm'); ?>
				<?php echo $this->form->getInput('farm','',$this->item->farm); ?></li>

				<li><div id="crops"><?php echo $this->form->getLabel('crop'); ?>
				<?php echo $this->form->getInput('crop','',$this->item->crop); ?></div></li>

				<li><div id="zones"><?php echo $this->form->getLabel('zone'); ?>
				<?php echo $this->form->getInput('zone','',$this->item->zone); ?> </div></li>

				<li><div id="beds"><?php echo $this->form->getLabel('bed'); ?>
				<?php echo $this->form->getInput('bed','',$this->item->bed); ?></div></li>

				<li><?php echo $this->form->getLabel('notes'); ?>
				<?php echo $this->form->getInput('notes','',$this->item->notes); ?></li>

				<li><?php echo $this->getActivityStatus(); ?></li>

				<li><?php echo $this->form->getLabel('access'); ?>
				<?php echo $this->form->getInput('access','',$this->item->access); ?></li>

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
		<?php echo JHtml::_('sliders.start', 'activity-sliders-'.$this->item->id, array('useCookie'=>1)); ?>
        <?php echo JHtml::_('sliders.panel', JText::_('Tending Activity'), 'tending-activity'); ?>
		<fieldset class="panelform">
			<ul class="adminformlist">
				<li><?php echo $this->getActivityType(); ?></li>

				<li><?php echo $this->getActivityMode(); ?></li>

				<li><?php echo $this->form->getLabel('quantity'); ?>
				<?php echo $this->form->getInput('quantity','',$this->item->quantity); ?></li>

				<li><?php echo $this->getUnitMeasureType(); ?></li>

			</ul>
		</fieldset>

        <?php echo JHtml::_('sliders.panel', JText::_('Labor'), 'llabor-activity'); ?>
		<fieldset class="panelform">
			<ul class="adminformlist">
				<li><?php echo $this->form->getLabel('labor_category_id'); ?>
				<?php echo $this->form->getInput('labor_category_id','',$this->item->labor_category_id); ?></li>

				<li><?php echo $this->form->getLabel('cost'); ?>
				<?php echo $this->form->getInput('cost','',$this->item->cost); ?></li>

			</ul>
		</fieldset>

        <?php echo JHtml::_('sliders.panel', JText::_('Materials'), 'material-activity'); ?>
		<fieldset class="panelform">
			<ul class="adminformlist">
				<li><?php echo $this->form->getLabel('material_cost'); ?>
				<?php echo $this->form->getInput('material_cost','',$this->item->material_cost); ?></li>

				<li><?php echo $this->form->getLabel('date_of_purchase'); ?>
				<?php echo $this->form->getInput('date_of_purchase','',$this->item->date_of_purchase); ?></li>

				<li><?php echo $this->form->getLabel('vendor'); ?>
				<?php echo $this->form->getInput('vendor','',$this->item->vendor); ?></li>

				<li><?php echo $this->form->getLabel('order_no'); ?>
				<?php echo $this->form->getInput('order_no','',$this->item->order_no); ?></li>

			</ul>
		</fieldset>

		<?php echo JHtml::_('sliders.end'); ?>

		<input type="hidden" name="task" value="" />
		<?php echo JHtml::_('form.token'); ?>
	</div>

	<div class="clr"></div>
</form>

<script language="javascript">
window.addEvent('domready', function() { //alert('kk');
    $('farm').addEvent('change', function(e) {
    //	$('bedid').empty();
    	e.stop(); 
    	var val=document.getElementById('farm').value;
    	var zone=document.getElementById('zone').value;
    	var id =document.getElementById('id').value;
    	var myElement = document.getElementById('zones');
    	var bedElement = document.getElementById('beds');
    	var cropElement = document.getElementById('crops');
      	var url = 'index.php?option=com_farmapp&view=activities&task=findzones&format=raw&val='+val+'&activityid='+id;
        var x = new Request({
            url: url,
            method: 'GET',
            onSuccess: function(responseText){ 
        	myElement.set('html', responseText);
        	$('zone').addEvent('change', function(e1) {
        	var zone1 = document.getElementById('zone').value;  
          	var url1 = 'index.php?option=com_farmapp&view=activities&task=findbeds&format=raw&val='+val+'&activityid='+id+'&zoneid='+zone1;
            var xx = new Request({
                url: url1,
                method: 'GET',
                onSuccess: function(responseText){ 
            	bedElement.set('html', responseText);
            $('bed').addEvent('change', function(e1) {	
            	var bed = document.getElementById('bed').value;
            	var zone2 = document.getElementById('zone').value;
             	var url2 = 'index.php?option=com_farmapp&view=activities&task=findcrops&format=raw&val='+val+'&activityid='+id+'&zoneid='+zone2+'&bedid='+bed;
                var xxx = new Request({
                    url: url2,
                    method: 'GET',
                    onSuccess: function(responseText){ 
                	cropElement.set('html', responseText);

                }
                    }).send();
            });       	
            }
                }).send();
        });
        }
            }).send();
        
        


        });


    });
window.addEvent('load', function() {
	//function is calling for getting the all the beds, is defined in js (function.js)
	var id=document.getElementById('id').value;
	if(id !=0){ 
	 onloadcrop(id);
    }
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

}

</script>