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
$filename = 'joomla.javascript.js';
$path = 'includes/js/';
JHTML::script($filename, $path);
//var_dump($this->item);die;
?>
<form action="<?php echo JRoute::_('index.php?option=com_farmapp&view=activities'); ?>" method="post" name="adminForm" id="formId" >
    <div class="customcsstoolbar">
	<?php echo $this->getToolbar();?>
	</div>
	<div class="width-60 fltlft">
		<fieldset class="adminform fieldsetborder">
			<legend><?php echo empty($this->item->id) ? JText::_('COM_FARMAPP_NEW_ACTIVITY') : JText::sprintf('COM_FARMAPP_EDIT_ACTIVITY', $this->item->id); ?></legend>
			<ul class="adminformlist forpeoplefileds">
				<li><?php echo $this->form->getLabel('name'); ?>
				<?php echo $this->form->getInput('name','',$this->item->name); ?></li>

				<li><?php echo $this->form->getLabel('description'); ?>
				<?php echo $this->form->getInput('description','',$this->item->description); ?></li>
				
				<li><?php echo $this->form->getLabel('date_of_activity'); ?>
				<?php echo $this->form->getInput('date_of_activity','',$this->item->date_of_activity); ?></li>

				<li><?php echo $this->form->getLabel('duration'); ?>
				<?php echo $this->form->getInput('duration','',$this->item->duration); ?></li>


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
	<div class="width-40 fltrt activtyrightfields">
		<div class="blueheading">
        <?php echo 'Tending Activity'; ?>
         </div>
		<fieldset class="panelform fieldsetborder">
			<ul class="adminformlist">
				<li><?php echo $this->getActivityType(); ?></li>

		<!--Just commented as client guide..		<li><?php //echo $this->getActivityMode(); ?></li> -->

				<li><?php echo $this->form->getLabel('quantity'); ?>
				<?php echo $this->form->getInput('quantity','',$this->item->quantity); ?></li>

				<li><?php echo $this->getUnitMeasureType(); ?></li>

			</ul>
		</fieldset>
       <div class="blueheading">
        <?php echo 'Labor'; ?>
         </div>
		<fieldset class="panelform fieldsetborder">
			<ul class="adminformlist">
				<li><?php echo $this->form->getLabel('labor_category_id'); ?>
				<?php echo $this->form->getInput('labor_category_id','',$this->item->labor_category_id); ?></li>

				<li><?php echo $this->form->getLabel('cost'); ?>
				<?php echo $this->form->getInput('cost','',$this->item->cost); ?></li>

			</ul>
		</fieldset>
       <div class="blueheading">
        <?php echo 'Materials'; ?>
        </div>
		<fieldset class="panelform fieldsetborder">
			<ul class="adminformlist materials">
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



		<input type="hidden" name="task" value="" />
		<?php echo JHtml::_('form.token'); ?>
	</div>

	<div class="clr"></div>
</form>

<script language="javascript">
window.addEvent('domready', function() { 
    $('zone').addEvent('change', function(e) {
    //	$('bedid').empty();
    	e.stop(); 

    	var zone=document.getElementById('zone').value;
    	var bedElement = document.getElementById('beds');
      	var url = 'index.php?option=com_farmapp&view=activities&task=findbeds&format=raw&val='+zone;
        var x = new Request({
            url: url,
            method: 'GET',
            onSuccess: function(responseText){ 
        	bedElement.set('html', responseText);
            }
            }).send();

        });


    });
//window.addEvent('load', function() {
//	//function is calling for getting the all the beds, is defined in js (function.js)
//	var id=document.getElementById('id').value;
//	if(id !=0){ 
//	 onloadcrop(id);
//    }
//});

</script>
<script language="javascript">
function validate(formId)
{
	var flag=true;
	
	for(var i=0;i<formId.elements.length;i++)
	{
		//alert(formId.elements[i].className);
		if(formId.elements[i].className=="inputbox required")
		{
			if(isEmpty(formId.elements[i].value))
			{
				flag=false;
				formId.elements[i].style.border="1px solid red";
			}else{
				formId.elements[i].style.border="1px solid silver";
			}
		}
		else if(formId.elements[i].className=="inputbox float")
		{
		   
			if(isEmpty(formId.elements[i].value))
			{
				flag=false;
				formId.elements[i].style.border="1px solid red";
			}
			else
			{
				if(!isZero(formId.elements[i].value))
				{
				    flag=false;
				    formId.elements[i].style.border="1px solid red";
				}else{
				    formId.elements[i].style.border="1px solid silver";
				}
			}
		}
		else if(formId.elements[i].className=="inputbox int")
		{
		   
			if(isEmpty(formId.elements[i].value))
			{
				flag=true;
			//	formId.elements[i].style.border="1px solid red";
			}
			else
			{
				if(!isInt(formId.elements[i].value))
				{
				    flag=false;
				    formId.elements[i].style.border="1px solid red";
				}else{
				    formId.elements[i].style.border="1px solid silver";
				}
			}
		}
		else if(formId.elements[i].className=="inputbox time")
		{
			if(!isEmpty(formId.elements[i].value))
			{
				if(!IsValidTime(formId.elements[i].value))
				{
					flag=false;
					formId.elements[i].style.border="1px solid red";
				}else{
				    formId.elements[i].style.border="1px solid silver";
				}
			}
		}
		else if(formId.elements[i].className=="inputbox numeric")
		{
		   
			if(isEmpty(formId.elements[i].value))
			{
				flag=false;
				formId.elements[i].style.border="1px solid red";
			}
			else
			{
				if(!isZero(formId.elements[i].value))
				{
				    flag=false;
					formId.elements[i].style.border="1px solid red";
				}else{
				    formId.elements[i].style.border="1px solid silver";
				}
			}
		}
		else if(formId.elements[i].className=="required email")
		{
			if(isEmpty(formId.elements[i].value))
			{
				formId.elements[i].style.border="1px solid red";
			}else{
				if(!isEmail(formId.elements[i].value)){
					flag=false;
					formId.elements[i].style.border="1px solid red";
				}else{
				   formId.elements[i].style.border="1px solid silver";
				}
			}
		}
		else if(formId.elements[i].className=="required list")
		{
			if(!isSelected(formId.elements[i].value))
			{
				flag=false;
				formId.elements[i].style.border="1px solid red";
			}else{
				    formId.elements[i].style.border="1px solid silver";
				}
		}
		else if(formId.elements[i].className=="required date")
		{
		  // alert(formId.elements[i].value);
			if(isEmpty(formId.elements[i].value))
			{   
				flag=false;
				formId.elements[i].style.border="1px solid red";
			}
			else
			{
				if(!Ischeckdate(formId.elements[i].value))
				{
				    flag=false;
					formId.elements[i].style.border="1px solid red";
				}else{
				    formId.elements[i].style.border="1px solid silver";
				}
			}
		}	
		else if(formId.elements[i].className=="required password")
		{
			flag=validatePwd(formId);
		}
		
	}
	
	return flag;
}
function isInt(strString) //  check for valid INT strings	
{
	if(!/\D/.test(strString)) return true;//IF NUMBER
	else return false;
}
function isNumeric(strString) //  check for valid numeric strings	
{
	if(!/\D/.test(strString)) return true;//IF NUMBER
	else if(/^\d+\.\d+$/.test(strString)) return true;//IF A DECIMAL NUMBER HAVING AN INTEGER ON EITHER SIDE OF THE DOT(.)
	else return false;
}
function isEmpty(str) {
    // Check whether string is empty.
    for (var intLoop = 0; intLoop < str.length; intLoop++)
       if (" " != str.charAt(intLoop))
          return false;
    return true;
}
function isSelected(str) {
    // Check whether string is empty.
   if(str==0)
   return false;
   
   return true;
}
function isEmail(str) {
    // Check whether string is empty.
    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;  
   return emailPattern.test(str);  
}

 function checkRequired(f) {
    var strError = "";
    for (var intLoop = 0; intLoop<f.elements.length; intLoop++)
       if (null!=f.elements[intLoop].getAttribute("required")) 
          if (isEmpty(f.elements[intLoop].value))
             strError += "  " + f.elements[intLoop].name + "\n";
    if ("" != strError) {
       alert("Required data is missing:\n" + strError);
       return false;
    }
 }
 
 
 function validatePwd(f)
 {
	 var invalid = " "; // Invalid character is a space
	 var minLength = 6; // Minimum length
	 var pw1 = document.getElementById('password');
	 var pw2 = document.getElementById('password2');
	 var parent= pw2.parentNode
	 var descText = document.createTextNode('');
	 // check for a value in both fields.
	 if (isEmpty(pw1.value)) {
	   alert('Please enter your password.');
	   pw1.style.border="1px solid red";
	   return false;
	 }
	 if(isEmpty(pw2.value)){
		 alert('Please retype your password twice.');
		pw2.style.border="1px solid red";
		return false;
	 }
	 // check for minimum length
//	 if (pw1.value.length < minLength) {
//	 alert('Your password must be at least ' + minLength + ' characters long. Try again.');
//	 return false;
//	 }
	 // check for spaces
	 if (pw1.value.indexOf(invalid) > -1) {
	 alert("Sorry, spaces are not allowed.");
	 return false;
	 }
	 else {
		 if (pw1.value != pw2.value) {
			 alert ("You did not enter the same new password twice. Please re-enter your password.");
			 pw1.style.border="1px solid red";
			 pw2.style.border="1px solid red";
		     return false;
		 }
		 else 
		 {
			 pw1.style.border="1px solid #7f9db9";
			 pw2.style.border="1px solid #7f9db9";
		     return true;
		  }
	 }
}
 function IsValidTime(timeStr) {
	// Checks if time is in HH:MM:SS AM/PM format.
	// The seconds and AM/PM are optional.

	var timePat = /^(\d{1,2}):(\d{2})(:(\d{2}))?(\s?)?$/;

	var matchArray = timeStr.match(timePat);
	if (matchArray == null) {
	alert("Time is not in a valid format.");
	return false;
	}
	hour = matchArray[1];
	minute = matchArray[2];
	
	if (hour < 0  || hour > 23) {
	alert("Hour must be between 0 and 23.");
	return false;
	}
	
	if (minute<0 || minute > 59) {
	alert ("Minute must be between 0 and 59.");
	return false;
	}
	
	return true;
}
 
 function Ischeckdate(date){ 
   var validformat=/^\d{4}[\/\-](0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])$/; //Basic check for format validity
   var returnval=false;
 //  alert(date);
   if (!validformat.test(date))
   {  
      return false;
   }
   else{ //Detailed check for valid date ranges
   var yearfield = date.split("-")[0];
   var monthfield = date.split("-")[1]; 
   var dayfield = date.split("-")[2]; 
   var dayobj = new Date(yearfield, monthfield-1, dayfield);
   if ((dayobj.getMonth()+1!=monthfield)||(dayobj.getDate()!=dayfield)||(dayobj.getFullYear()!=yearfield))
   { 
     return false;
   }
   
   else
   {
     var currentDate = new Date();
     var day = currentDate.getDate();
     var month = currentDate.getMonth() + 1;
     var year = currentDate.getFullYear();
  //    alert(day); alert(month); alert(year); 
     var todayStr = year + '-' + month + '-'  + day;
     if(yearfield<year) 
        return false;
       else if(yearfield<=year && monthfield<month)
       return false;
       else if(yearfield<=year && monthfield==month && dayfield<day)
      return false;
      else 
     return true;
}  
   }
}



 /*for show image when selected by drop down*/
 
 

	function changeDisplayImage() {
		
		if (document.adminForm.image.value !='') {
			document.adminForm.imagelib.src='../images/offers/' + document.adminForm.image.value;
		} else {
			document.adminForm.imagelib.src='images/blank.png';
		}
	}
	
	function isZero(strString) //  check for valid numeric strings	
	{
		if(strString>0) return true;//IF NUMBER
		else return false;
	}
Joomla.submitbutton = function(task)
{
	if (task == 'cancel' || validate(document.getElementById('formId'))) {
		
		Joomla.submitform(task, document.getElementById('formId'));
	}
	else {
		alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'));?>');
	}

}

</script>
<script type="text/javascript">jQuery.noConflict();</script>
