<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
/* Set mime type to JSON */
$doc =& JFactory::getDocument();
$doc->setMimeEncoding('application/json');
/* Get callback function name */
$callback = JRequest::getVar('callback');
if($callback!='') {
	echo $callback."(";
}
?>{
	"layout":"category",
	"title":"<?php echo str_replace('"','\"',$this->category->title); ?>",
	"alias":"<?php echo str_replace('"','\"',$this->category->alias); ?>",
	"description":"<?php echo str_replace('"','\"',$this->category->description); ?>",
	"url":"<?php echo str_replace('"','\"',JRoute::_(FlexicontentHelperRoute::getCategoryRoute($this->category->slug))); ?>",
	"items":[
<?php echo $this->loadTemplate('items'); ?>
	]
}<?php
if($callback!='') {
	echo ");";
}