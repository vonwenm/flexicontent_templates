<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
$numItems = count($this->items);
$i = 0;
foreach($this->items as $item) { ?>
		{
			"layout":"item",
			"title":"<?php echo str_replace('"','\"',$item->title); ?>",
			"alias":"<?php echo str_replace('"','\"',$item->alias); ?>",
			"created":"<?php echo str_replace('"','\"',$item->created); ?>",
			"modified":"<?php echo str_replace('"','\"',$item->modified); ?>",
			"metakey":"<?php echo str_replace('"','\"',$item->metakey); ?>",
			"metadesc":"<?php echo str_replace('"','\"',$item->metadesc); ?>",
			"author":"<?php echo str_replace('"','\"',$item->author); ?>",
			"description":"<?php echo str_replace('"','\"',$item->text); ?>",
			"tags":[<?php 
					if(count($item->tags)>0){
						$tags = Array();
						foreach($item->tags as $tag) {
							array_push($tags,str_replace('"','\"',$tag->name)); 
						}
						echo '"'.implode('","',$tags).'"';
					} ?>],
			"url":"<?php echo str_replace('"','\"',JRoute::_(FlexicontentHelperRoute::getItemRoute($item->slug, $item->categoryslug))); ?>",
			"fields":{
<?php
	if(isset($item->positions['renderonly'])) {
		$fields = Array();
		foreach($item->positions['renderonly'] as $field) {
			if(isset($item->fieldvalues[$field->id])){
				$fieldvalues = Array();
				foreach($item->fieldvalues[$field->id] as $fieldvalue){
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
				array_push($fields,"\t\t\t\t".'"'.str_replace('"','\"',$field->name).'":['.$value.']');
			}
		}
		echo implode(",\n",$fields);
}?>

			}
		}<?php
	if(++$i !== $numItems) {
		echo ",\n";
	}
}