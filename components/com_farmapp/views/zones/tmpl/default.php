<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access'); 
// load tooltip behavior
//echo "dcds"; exit;
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
$filename = 'joomla.javascript.js';
$path = 'includes/js/';
JHTML::script($filename, $path);
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
require_once JPATH_COMPONENT .'/helpers/farmapp.php';
$listOrder   = $this->state->get('list.ordering');
$listDirn   = $this->state->get('list.direction');


?>
<script type="text/javascript">
	 (function($){
		 $(document).ready(function(){
				$(function() {
					$( "a.jgrid" ).click(function(){ 
						var checkedid = $(this).attr('checkedid'); 
						if(parseInt($("span.text"+checkedid).text()) == 1){
							$('[name="task"]').val('unpublish');
						}else{
							$('[name="task"]').val('publish');
						}
						$('[name="cid[]"]').val(checkedid);
						$('[name="adminForm"]').submit();
					});
				});

		 });
	 })(window.jQuery);
</script>
<form action="<?php echo JRoute::_('index.php?option=com_farmapp&view=zones'); ?>" method="post" name="adminForm" id="adminForm">
	   <h2 class="titleheadingfrontend">Zones</h2>
		<div id="zonestoolbar"><?php echo $this->getToolbar(); ?></div>
		<fieldset id="filter-bar">
	<div class="filter-search fltlft">
			<label class="filter-search-lbl" for="filter_search"><?php echo JText::_('JSEARCH_FILTER_LABEL'); ?></label>
			<input type="text" name="filter_search" id="filter_search" value="<?php echo $this->escape($this->state->get('filter.search')); ?>" title="<?php echo JText::_('COM_BANNERS_SEARCH_IN_TITLE'); ?>" />
			<button type="submit"><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
			<button type="button" onclick="document.id('filter_search').value='';this.form.submit();"><?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?></button>
		</div>
			</fieldset>
	<div class="clr"> </div>
	<table class="adminlist">
		<thead><?php echo $this->loadTemplate('head');?></thead>
		<tfoot><?php echo $this->loadTemplate('foot');?></tfoot>
		<tbody class="listelementslink"><?php echo $this->loadTemplate('body');?></tbody>
	</table>
	<div>
	    <input type="hidden" name="cid[]" value="" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
		<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>
