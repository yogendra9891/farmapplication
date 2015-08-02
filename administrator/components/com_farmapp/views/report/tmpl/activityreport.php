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
<form action="<?php echo JRoute::_('index.php?option=com_farmapp&view=report&task=activityreport'); ?>" method="post" name="adminForm" onsubmit="return validateForm()">

	<div class="width-100 fltlft">
		<fieldset class="adminform activityreport">
			<ul class="adminformlist">
			<li><?php echo $this->actform->getLabel('farm'); ?>
			<select name="farm" id="farm" class="inputbox" onchange="onchangethefarmonactivityreportpage();">
				<?php echo JHtml::_('select.options', FarmappHelper::getFarmOptions(), 'value', 'text');?>
			</select>
				</li>
	
				
				<li><?php echo $this->actform->getLabel('crop'); ?>
				<?php echo $this->actform->getInput('crop'); ?></li>

				<li><div id="zones"><?php echo $this->actform->getLabel('zone'); ?>
				<?php echo $this->actform->getInput('zone'); ?></div></li>
				
				<li><div id="beds"><?php echo $this->actform->getLabel('bed'); ?>
				<?php echo $this->actform->getInput('bed'); ?></div></li>
			</ul>	
               <ul class="adminformlist">
				<li><?php echo $this->actform->getLabel('startdate'); ?>
				<?php echo $this->actform->getInput('startdate'); ?></li>

				<li><?php echo $this->actform->getLabel('enddate'); ?>
				<?php echo $this->actform->getInput('enddate'); ?></li>
				
				<li><label></label><button class="reportsubmitbutton activityreportsubmit" type="submit"><?php echo JText::_('Submit') ?></button></li>
				
			</ul>
			
		</fieldset>
	</div>
	
	<div class="clr"> </div>
	<table class="adminlist activityreportpage">
		<thead>
		<tr>
				<th width="1%">
					<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($this->items); ?>);" />
				</th>	
				
				<th width="20%" style="text-align:left;">
				<?php echo JHtml::_('grid.sort', 'Name', 'a.name' ); ?>
				</th>
				
	 
 
 				<th width="20%" style="text-align:left;">
					<?php echo JText::_( 'Status' ); ?>
				</th>
                
                 <th width="20%" style="text-align:left;">
					<?php echo JText::_( 'Description' ); ?>
				</th>
                
				<th width="20%" style="text-align:left;">
					<?php echo JText::_('Labor Category' ); ?>
				</th>

				<th width="20%" style="text-align:left;">
					<?php echo JText::_('Zone/Bed' ); ?>
				</th>
 
				<th width="20%" style="text-align:left;">
					<?php echo JText::_('ID' ); ?>
				</th>
	
</tr>
		
		</thead>
		
		<tbody>
		<?php	 $k = 0;
			  for ($i=0, $n=count( $this->items ); $i < $n; $i++)
   				 {
			  $row =& $this->items[$i];
	       

		//	$ordering	= ($this->state->get('list.ordering') == 'a.ordering');
			?>
	<tr class="row<?php echo $i % 2; ?>">
		<td>
			<?php echo $checked;?>
		</td>
		<td>
			<?php echo $row->activityname; ?>
		</td>
		<td>
		    <?php echo $row->status; ?>
		</td>
		<td>
		    <?php echo $row->description; ?>
		</td>
            
		<td>
		    <?php echo $row->Laborcategory; ?>
		</td>
        	
		<td>
			<?php echo $row->zonebeds; ?>
		</td>

		<td>
			<?php echo $row->activityid; ?>
		</td>
	</tr>
<?php
 		$k = 1 - $k; 
		} ?> </tbody>
	</table>
	<div>
		<input type="hidden" name="layout" value="activityreport" />
		<input type="hidden" name="boxchecked" value="0" />

		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>
<script language="javascript">
window.addEvent('load', function() {
  document.getElementById('startdate').value = "<?php echo $startdate;?>";
  document.getElementById('enddate').value = "<?php echo $enddate;?>";
  document.getElementById('crop').value = "<?php echo $cropid;?>";
  document.getElementById('farm').value = "<?php echo $farmid;?>";
  var zoneid = "<?php echo $zoneid;?>";
  var bedid  = "<?php echo $bedid;?>";
  //here we are calling a function of function.js and update the zones dropdown.... 
  onloadactivitypage(zoneid, bedid);
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