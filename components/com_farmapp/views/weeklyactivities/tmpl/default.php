<?php
// No direct access to this file

defined('_JEXEC') or die('Restricted Access'); 
// load tooltip behavior
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
$filename = 'joomla.javascript.js';
$path = 'includes/js/';
JHTML::script($filename, $path);
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
require_once JPATH_COMPONENT .'/helpers/farmapp.php';
//$listOrder   = $this->state->get('list.ordering');
//$listDirn   = $this->state->get('list.direction');
?>
<script type='text/javascript'>
(function($){
	$(document).ready(function() {
		$('#calendar').fullCalendar({
			header: {
				left: '',
				center: 'prev,title,next',
				right: ''
			},
			defaultView: 'basicWeek',
			aspectRatio: 6.35,
			columnFormat: {
				month: 'dddd'
			},
			events: "index.php?option=com_farmapp&view=activities&task=activitiesevents&format=raw",		       
			dayClick: function(date, allDay, jsEvent, view) {
				var dateText = date.getFullYear() + '-' + (date.getMonth()+ 1) + '-' + date.getDate();
				$.fancybox({
					ajax : {data: {event_date:dateText}},
					href: $('#eventpopup').val(),
					showCloseButton: false,
					autoScale: true,
					padding: 0,
					centerOnScroll: true
				});
   		}
	});
	$(".fc-event-popup").fancybox({
		'showCloseButton': false,
		'autoScale': true,
		'padding': 0
	});
	});
})(window.jQuery);
</script>
<style type='text/css'>

	body {
		margin-top: 40px;
		text-align: center;
		font-size: 14px;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		}

	#calendar {
		width: 650px;
		margin: 0 auto;
		height: 500px;
		}

</style>

<div class="activitytabtoolbar">
<form action="<?php echo JRoute::_('index.php?option=com_farmapp&view=activities'); ?>" method="post" name="adminForm" id="adminForm">
	   <h2 class="titleheadingfrontend">Calendar of Activities</h2>
		<div id="zonestoolbar"><?php echo $this->getToolbar(); ?></div>
        <div><span class="viewofactivity">VIEW :&nbsp;</span> <a href="<?php echo JRoute::_('index.php?option=com_farmapp&view=activities'); ?>"> Daily </a>&nbsp; |
           &nbsp;  <a href="<?php echo JRoute::_('index.php?option=com_farmapp&view=activities&task=weeklyactivities'); ?>"  class="activemodeofactivity">  Weekly </a>&nbsp;  |  
            &nbsp; <a href="<?php echo JRoute::_('index.php?option=com_farmapp&view=activities&task=monthlyactivities'); ?>"> Monthly </a></div>

 	<div class="clr"> </div>
        <div id='calendar' class="calendarwidth"></div>
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
 <input type="hidden" id="eventpopup" value="<?php echo JRoute::_('index.php?option=com_farmapp&view=activities&task=eventdetail&tmpl=component');?>" />
		<?php echo JHtml::_('form.token'); ?>
	
</form>
</div>
<script type="text/javascript">jQuery.noConflict();</script>