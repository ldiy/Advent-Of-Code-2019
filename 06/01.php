<?php
$lines = file("input.txt", FILE_IGNORE_NEW_LINES);
$result = 0;
function comDistance($obj,&$lines){
	foreach($lines as $line){
		$objects = explode(")",$line);
		if($objects[1] == $obj){
			return 1 + comDistance($objects[0],$lines);
		}
	}
	return 0;
}
foreach($lines as $line){
	$result += comDistance(explode(")",$line)[1],$lines);
}
echo $result;
?>