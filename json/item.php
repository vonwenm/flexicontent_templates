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
	"layout":"item",
	"title":"<?php echo str_replace('"','\"',$this->item->title); ?>",
	"alias":"<?php echo str_replace('"','\"',$this->item->alias); ?>",
	"created":"<?php echo str_replace('"','\"',$this->item->created); ?>",
	"modified":"<?php echo str_replace('"','\"',$this->item->modified); ?>",
	"metakey":"<?php echo str_replace('"','\"',$this->item->metakey); ?>",
	"metadesc":"<?php echo str_replace('"','\"',$this->item->metadesc); ?>",
	"author":"<?php echo str_replace('"','\"',$this->item->author); ?>",
	"description":"<?php echo str_replace('"','\"',$this->item->text); ?>",
	"tags":[<?php 
			if(count($this->item->tags)>0){
				$tags = Array();
				foreach($this->item->tags as $tag) {
					array_push($tags,str_replace('"','\"',$tag->name)); 
				}
				echo '"'.implode('","',$tags).'"';
			} ?>],
	"url":"<?php echo str_replace('"','\"',JRoute::_(FlexicontentHelperRoute::getItemRoute($this->item->slug, $this->item->categoryslug))); ?>",
	"fields":{
<?php
if(isset($this->item->positions['renderonly'])) {
	$fields = Array();
	foreach($this->item->positions['renderonly'] as $field) {
		if(isset($this->item->fieldvalues[$field->id])){
			$fieldvalues = Array();
			foreach($this->item->fieldvalues[$field->id] as $fieldvalue){
				$unserval = unserialize($fieldvalue);
				if($unserval) {
					$valuearray = Array();
					foreach($unserval as $key => $val) {
						$valueobj = '"'.str_replace('"','\"',$key).'":"';
						$val = str_replace("\r",'',str_replace("\n",'\n',str_replace('"','\"',$val))); // Escape double quotes, escape line feeds, remove carrier return
						$valueobj .= $val.'"';
						array_push($valuearray,$valueobj);
					}
					$unserval = implode(',',$valuearray);
					$unserval = '{'.$unserval.'}';
				}
				else {
					$unserval = '"'.str_replace("\r",'',str_replace("\n",'\n',str_replace('"','\"',$fieldvalue))).'"'; // Escape double quotes, escape line feeds, remove carrier return
				}
				array_push($fieldvalues,$unserval);
			}
			$value = implode(',',$fieldvalues);
			array_push($fields,"\t\t".'"'.str_replace('"','\"',$field->name).'":['.$value.']');
		}
	}
	echo implode(",\n",$fields);
}?>

	}
}<?php
if($callback!='') {
	echo ");";
}