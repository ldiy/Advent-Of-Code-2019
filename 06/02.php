<?php
$lines = file("input.txt", FILE_IGNORE_NEW_LINES);
$youtocom = array();
$santocom = array();
/* calc path to COM and save in $youtocom or $santocom */
function comDistance($obj,&$path){
	global $lines, $result;
	foreach($lines as $line){
		$objects = explode(")",$line);		
		if($objects[1] == $obj){
			array_push($path,$objects[0]);
			return 1 + comDistance($objects[0],$path);
		}
	}
	return 0;
}

/* search for lines with YOU and SAN */
foreach($lines as $line){
	$objects = explode(")",$line);
	$currObject = $objects[1];
	if($currObject == "YOU")
		comDistance($currObject,$youtocom);
	elseif($currObject == "SAN")
		comDistance($currObject,$santocom);
}
/* calc distance between */
$ok= true;
for($i=0;$i<count($youtocom) && $ok ;$i++){
	for($x=0;$x<count($santocom) && $ok;$x++){
		if($youtocom[$i] == $santocom[$x]){
			echo "result: " . ($i + $x);
			$ok =false;
		}
	}
}
?>