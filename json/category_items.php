<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
$numItems = count($this->items);
$i = 0;
foreach($this->items as $item) { ?>
		{
			"layout":"item",
			"title":"<?php echo jsonEscapeString($item->title); ?>",
			"alias":"<?php echo jsonEscapeString($item->alias); ?>",
			"created":"<?php echo jsonEscapeString($item->created); ?>",
			"modified":"<?php echo jsonEscapeString($item->modified); ?>",
			"metakey":"<?php echo jsonEscapeString($item->metakey); ?>",
			"metadesc":"<?php echo jsonEscapeString($item->metadesc); ?>",
			"author":"<?php echo jsonEscapeString($item->author); ?>",
			"description":"<?php echo jsonEscapeString($item->text); ?>",
			"tags":[<?php 
					if(count($item->tags)>0){
						$tags = Array();
						foreach($item->tags as $tag) {
							array_push($tags,jsonEscapeString($tag->name)); 
						}
						echo '"'.implode('","',$tags).'"';
					} ?>],
			"url":"<?php echo jsonEscapeString(JRoute::_(FlexicontentHelperRoute::getItemRoute($item->slug, $item->categoryslug))); ?>",
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
							$val = jsonEscapeString($val);
							$valueobj .= $val.'"';
							array_push($valuearray,$valueobj);
						}
						$unserval = implode(',',$valuearray);
						$unserval = '{'.$unserval.'}';
					}
					else {
						$unserval = '"'.jsonEscapeString($fieldvalue).'"';
					}
					array_push($fieldvalues,$unserval);
				}
				$value = implode(',',$fieldvalues);
				array_push($fields,"\t\t\t\t".'"'.jsonEscapeString($field->name).'":['.$value.']');
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