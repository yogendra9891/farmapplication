<?php
//echo "jkj";
//exit;
// No direct access to this file
//var_dump($this->items); die;
defined('_JEXEC') or die('Restricted Access'); 
// load tooltip behavior
JHtml::_('behavior.tooltip');
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
require_once JPATH_COMPONENT .'/helpers/farmapp.php';
//$listOrder   = $this->state->get('list.ordering');
//$listDirn   = $this->state->get('list.direction');
 $startdate = $this->data[0];
 $enddate = $this->data[1];
 $cropid = $this->data[2];
 $farmid = $this->data[3];
 $zoneid = $this->data[4];
 $bedid  =  $this->data[5];
?>
<form action="<?php echo JRoute::_('index.php?option=com_farmapp&view=report&task=profitlossreport'); ?>" method="post" name="adminForm" onsubmit="return validateForm()">

	<div class="width-100 fltlft">
		<fieldset class="adminform activityreport">
			<ul class="adminformlist">
			<li><?php echo $this->finform->getLabel('farm'); ?>
			<select name="farm" id="farm" class="inputbox" onchange="onchangethefarmonactivityreportpage();">
				<?php echo JHtml::_('select.options', FarmappHelper::getFarmOptions(), 'value', 'text');?>
			</select>
				</li>

				<li><?php echo $this->finform->getLabel('pcrop'); ?>
				<?php echo $this->finform->getInput('pcrop'); ?></li>

				<li><div id="zones"><?php echo $this->finform->getLabel('pzone'); ?>
				<?php echo $this->finform->getInput('pzone'); ?></div></li>
				
				<li><div id="beds"><?php echo $this->finform->getLabel('pbed'); ?>
				<?php echo $this->finform->getInput('pbed'); ?></div></li>
          </ul>
           <ul class="adminformlist">
				<li><?php echo $this->finform->getLabel('pstartdate'); ?>
				<?php echo $this->finform->getInput('pstartdate'); ?></li>

				<li><?php echo $this->finform->getLabel('penddate'); ?>
				<?php echo $this->finform->getInput('penddate'); ?></li>
				
				<li><label></label><button class="reportsubmitbutton activityreportsubmit" type="submit"><?php echo JText::_('Submit') ?></button></li>
				
			</ul>
			
		</fieldset>
	</div>
	
	<div class="clr"> </div>
	<table class="adminlist">
		<thead>
		<tr>
				<th width="1%">
					<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($this->items); ?>);" />
				</th>	
				
				<th width="20%" style="text-align:left;">
				<?php echo JHtml::_('grid.sort', 'Name', 'a.name' ); ?>
				</th>
				
                
                 <th width="40%" style="text-align:left;">
					<?php echo JText::_( 'Description' ); ?>
				</th>
                
 
                <th width="5" style="text-align:left;">
				<?php echo JHtml::_('grid.sort', 'ID', 'a.id'); ?>
				</th>	
	
</tr>
		
		</thead>
		
		<tbody>
		<?php	 $k = 0;
			?>
	<tr class="row profitlossreport">
		<td>
			<?php echo $checked;?>
		</td>
		<td>
			<?php echo JText::_('Income');?>
		</td>
		<td>
			<?php echo '$'.$this->items[0];?>
		</td>
		<td>
			
		</td>

	</tr>
	<tr class="row laborexpense">
		<td>
			<?php echo $checked;?>
		</td>
		<td>
			<?php echo JText::_('Labor Expense');?>
		</td>
		<td>
			<?php echo '-$'.$this->items[1];?>
		</td>
		<td>
			
		</td>

	</tr>
	<tr class="row profitlossreport">
		<td>
			<?php echo $checked;?>
		</td>
		<td>
			<?php echo JText::_('Metrial Expenses');?>
		</td>
		<td>
			<?php echo '-$'.$this->items[2];?>
		</td>
		<td>
			
		</td>

	</tr>
	<tr class="row laborexpense">
		<td>
			<?php echo $checked;?>
		</td>
		<td>
			<?php echo JText::_('Total');?>
		</td>
		<td>
			<?php echo '$'.$this->items[3];?>
		</td>
		<td>
			
		</td>

	</tr>

			<?php
 		$k = 1 - $k; 
		 ?> </tbody>
	</table>
	<div>
		<input type="hidden" name="layout" value="activityreport" />
		<input type="hidden" name="boxchecked" value="0" />

		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>
<script language="javascript">
window.addEvent('load', function() {
  document.getElementById('pstartdate').value = "<?php echo $startdate;?>";
  document.getElementById('penddate').value = "<?php echo $enddate;?>";
  document.getElementById('pcrop').value = "<?php echo $cropid;?>";
  document.getElementById('farm').value = "<?php echo $farmid;?>";
  var zoneid = "<?php echo $zoneid;?>";
  var bedid  = "<?php echo $bedid;?>";
  //here we are calling a function of function.js and update the zones dropdown.... 
  onloadprofitlosspage(zoneid, bedid);
//  document.getElementById('bed').value = "<?php echo $bedid;?>";
});
function validateForm()
{
var x=document.forms["adminForm"]["farm"].value;
var y=document.forms["adminForm"]["crop"].value;
if (x==0)
  {  
	document.getElementById('farm').style.borderColor= 'red';

    return false;
  }
if (y==0)
{  
	document.getElementById('crop').style.borderColor= 'red';

  return false;
}
}
</script>