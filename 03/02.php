<?php
error_reporting(0);
$lines = file("input.txt", FILE_IGNORE_NEW_LINES);
$result = 10000000;
$field = array(array());
$path = 1;

function findOhterPath($x,$y,$myPath){
	global $field;

	if($field[$x+1][$y] != NULL && $field[$x+1][$y] != $myPath)
		return $field[$x+1][$y];
	
	elseif($field[$x-1][$y] != NULL && $field[$x-1][$y] != $myPath)
		return $field[$x-1][$y];
	
	elseif($field[$x][$y+1] != NULL && $field[$x][$y+1] != $myPath)
		return $field[$x][$y+1];
	
	elseif($field[$x][$y-1] != NULL && $field[$x][$y-1] != $myPath)
		return $field[$x][$y-1];
	
	
}

function calcDistance($xEnd,$yEnd,$pathNumber){
	global $lines;
	$line = $lines[$pathNumber-1];
	$x=0;
	$y=0;
	$instructions = explode(",",$line);
	$homedistance = 0;
	foreach($instructions as $instruction){
		$val = substr($instruction,1);
		switch($instruction[0]){
			case "U":
				for($i = 0; $i < $val; $i++){
					$y++;
					$homedistance++;
					if($x == $xEnd && $y == $yEnd)
						return $homedistance;
				}
				break;
			case "D":
				for($i = 0; $i < $val; $i++){
					$y--;
					$homedistance++;
					if($x == $xEnd && $y == $yEnd)
						return $homedistance;
				}
				break;
			case "L":
				for($i = 0; $i < $val; $i++){
					$x--;
					$homedistance++;
					if($x == $xEnd && $y == $yEnd)
						return $homedistance;
				}
				break;
			case "R":
				for($i = 0; $i < $val; $i++){
					$x++;
					$homedistance++;
					if($x == $xEnd && $y == $yEnd)
						return $homedistance;
				}
				break;
		
		}
	}
}
foreach($lines as $line){
	$x=0;
	$y=0;
	$instructions = explode(",",$line);
	$homedistance = 0;
	foreach($instructions as $instruction){
		$val = substr($instruction,1);
		switch($instruction[0]){
			case "U":
				for($i = 0; $i < $val; $i++){
					$y++;
					$homedistance++;
					if($field[$x][$y] == NULL || $field[$x][$y] == $path)
						$field[$x][$y] = $path;
					else{
						$field[$x][$y] = 'x';				
						$result = min($homedistance + calcDistance($x,$y,$otherPath = findOhterPath($x,$y,$path)) ,$result);
					}
				}
				break;
			case "D":
				for($i = 0; $i < $val; $i++){
					$y--;
					$homedistance++;
					if($field[$x][$y] == NULL || $field[$x][$y] == $path)
						$field[$x][$y] = $path;
					else{
						$field[$x][$y] = 'x';				
						$result = min($homedistance + calcDistance($x,$y,$otherPath = findOhterPath($x,$y,$path)) ,$result);
					}
				}
				break;
			case "L":
				for($i = 0; $i < $val; $i++){
					$x--;
					$homedistance++;
					if($field[$x][$y] == NULL || $field[$x][$y] == $path)
						$field[$x][$y] = $path;
					else{
						$field[$x][$y] = 'x';				
						$result = min($homedistance + calcDistance($x,$y,$otherPath = findOhterPath($x,$y,$path)) ,$result);
					}
				}
				break;
			case "R":
				for($i = 0; $i < $val; $i++){
					$x++;
					$homedistance++;
					if($field[$x][$y] == NULL || $field[$x][$y] == $path)
						$field[$x][$y] = $path;
					else{
						$field[$x][$y] = 'x';				
						$result = min($homedistance + calcDistance($x,$y,$otherPath = findOhterPath($x,$y,$path)) ,$result);
					}
				}
				break;
		
		}
		
	}
	
	$path++;
}
echo $result;
?>