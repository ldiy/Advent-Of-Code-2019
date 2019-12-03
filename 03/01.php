<?php
error_reporting(0);
$lines = file("input.txt", FILE_IGNORE_NEW_LINES);
$result = 10000000;
$field = array(array());
$path = 1;
foreach($lines as $line){
	$x=$y=0;
	$instructions = explode(",",$line);
	foreach($instructions as $instruction){
		$val = substr($instruction,1);
		for($i = 0; $i < $val; $i++){
				switch($instruction[0]){
					case "U":
						$y++;
						break;
					case "D":
						$y--;
						break;
					case "L":
						$x--;
						break;
					case "R":
						$x++;
						break;
				}
			if($field[$x][$y] == NULL || $field[$x][$y] == $path)
				$field[$x][$y] = $path;
			else{
				$field[$x][$y] = 'x';
				$result = min(abs($x)+abs($y),$result);
			}
		}
	}
	$path++;
}
echo $result;
?>