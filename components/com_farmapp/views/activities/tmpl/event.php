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
//var_dump($this->item);
if(!empty($this->item))
{
?>

<div id="calendatentry" class="eventpopup-bgarea">
<div><?php echo date('F d, Y', strtotime($this->item[0]['start']));?></div>
<h1> <?php echo ' '.$this->item[0]['title'];?></h1>
<div><span>Status of Activity::</span> <?php echo ' '.$this->item[0]['activity_status'];?></div>
<div><span>Activity mode::</span><?php echo ' '.$this->item[0]['activity_mode'];?></div>
<div><span>Location::</span><?php echo ' '.$this->item[0]['location'];?></div>

</div>
<?php $link = JRoute::_( 'index.php?option=com_farmapp&view=activities&task=edit&cid[]='. (int)$this->item[0]['id'] );?>
<div style="margin-left:10px; padding-bottom: 10px;"><a href="<?php echo $link; ?>">edit</a></div>
<?php } else{?>
<div id="calendatentry" class="eventpopup-bgarea">No Activity is schedule on this date yet. </div>
<?php }?>