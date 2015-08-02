<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access'); 
// load tooltip behavior
JHtml::_('behavior.tooltip');
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
require_once JPATH_COMPONENT .'/helpers/farmapp.php';
?>


<form action="<?php echo JRoute::_('index.php?option=com_farmapp&view=report&task=activityreport'); ?>" method="post" name="adminForm" id="farm-form" onsubmit="return validateForm()" >
<fieldset class="adminform">
<div class="width-60 fltlft">
			<select name="farm" id="farm" class="inputbox" onchange="onchangethefarm();">
				<?php echo JHtml::_('select.options', FarmappHelper::getFarmOptions(), 'value', 'text');?>
			</select>

</div>
</fieldset>
	<div class="width-60 fltlft profitloss">
		<fieldset class="adminform">
		<h2>
		<?php echo "Activity Report"; ?></h2>
			<ul class="adminformlist">
				<li><?php echo $this->actform->getLabel('startdate'); ?>
				<?php echo $this->actform->getInput('startdate'); ?></li>

				<li><?php echo $this->actform->getLabel('enddate'); ?>
				<?php echo $this->actform->getInput('enddate'); ?></li>
				
				<li><?php echo $this->actform->getLabel('crop'); ?>
				<?php echo $this->actform->getInput('crop'); ?></li>

				<li><div id="zones"><?php echo $this->actform->getLabel('zone'); ?>
				<?php echo $this->actform->getInput('zone'); ?></div></li>
				
				<li><div id="beds"><?php echo $this->actform->getLabel('bed'); ?>
				<?php echo $this->actform->getInput('bed'); ?></div></li>
				
				<li><label></label><button class="reportsubmitbutton" type="submit"><?php echo JText::_('Submit') ?></button></li>
				
			</ul>
			
		</fieldset>
	</div>
	<?php echo JHTML::_( 'form.token' ); ?>
	
</form>
<form action="<?php echo JRoute::_('index.php?option=com_farmapp&view=report&task=profitlossreport'); ?>" method="post" name="adminForm1" id="farm-form" onsubmit="return validateForm2()">
<div class="width-60 fltlft profitloss">
		<fieldset class="adminform">
		<h2>
		<?php echo "Profit/Loss Report"; ?></h2>
			<ul class="adminformlist">
				<li><?php echo $this->finform->getLabel('pstartdate'); ?>
				<?php echo $this->finform->getInput('pstartdate'); ?></li>

				<li><?php echo $this->finform->getLabel('penddate'); ?>
				<?php echo $this->finform->getInput('penddate'); ?></li>
				
				<li><?php echo $this->finform->getLabel('pcrop'); ?>
				<?php echo $this->finform->getInput('pcrop'); ?></li>

				<li><div id="zone1"><?php echo $this->finform->getLabel('pzone'); ?>
				<?php echo $this->finform->getInput('pzone'); ?></div></li>
				
				<li><div id="pbeds"><?php echo $this->finform->getLabel('pbed'); ?>
				<?php echo $this->finform->getInput('pbed'); ?></div></li>
				
				<li><label></label><button class="reportsubmitbutton" type="submit"><?php echo JText::_('Submit') ?></button></li>

			</ul>

		</fieldset>
	</div>
	<input type="hidden" name="finreport" value="1">
	<input type="hidden" id="farmid"  name="farm" value="">
</form>
<script language="javascript">
window.addEvent('load', function() {

});
function validateForm()
{ 
	var y=document.forms["adminForm"]["crop"].value;
	if (y==0)
	{  
		document.getElementById('crop').style.borderColor= 'red';
	
	  return false;
	}
}

function validateForm2()
{ 
	var y=document.forms["adminForm1"]["pcrop"].value;
	if (y==0)
	{  
		document.getElementById('pcrop').style.borderColor= 'red';
    	return false;
	}
	var z= document.forms["adminForm"]["farm"].value;
	document.getElementById('farmid').value = z; 
}

</script>