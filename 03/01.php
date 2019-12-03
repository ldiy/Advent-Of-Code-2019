<?php
error_reporting(0);
$lines = file("input.txt", FILE_IGNORE_NEW_LINES);
$result = 10000000;
$field = array(array());
$path = 1;
foreach($lines as $line){
	$x=0;
	$y=0;
	$instructions = explode(",",$line);
	foreach($instructions as $instruction){
		$val = substr($instruction,1);
		//echo "val: " . $val . PHP_EOL;
		switch($instruction[0]){
			case "U":
				//$y+=1;
				for($i = 0; $i < $val; $i++){
					$y++;
					if($field[$x][$y] == NULL || $field[$x][$y] == $path)
						$field[$x][$y] = $path;
					else{
						$field[$x][$y] = 'x';
						$result = min(abs($x)+abs($y),$result);
					}
				}
				break;
			case "D":
				//$y-=1;
				for($i = 0; $i < $val; $i++){
					$y--;
					if($field[$x][$y] == NULL || $field[$x][$y] == $path)
						$field[$x][$y] = $path;
					else{
						$field[$x][$y] = 'x';
						$result = min(abs($x)+abs($y),$result);
					}
				}
				break;
			case "L":
				//$x-=1;
				for($i = 0; $i < $val; $i++){
					$x--;
					if($field[$x][$y] == NULL || $field[$x][$y] == $path)
						$field[$x][$y] = $path;
					else{
						$field[$x][$y] = 'x';
						$result = min(abs($x)+abs($y),$result);
					}
				}
				break;
			case "R":
				//$x+=1;
				for($i = 0; $i < $val; $i++){
					$x++;
					//echo $x . PHP_EOL;
					if($field[$x][$y] == NULL || $field[$x][$y] == $path)
						$field[$x][$y] = $path;
					else{
						$field[$x][$y] = 'x';
						$result = min(abs($x)+abs($y),$result);
					}
				}
				break;
		
		}
		//echo "x: " . $x . " | y: " . $y . PHP_EOL;
	}
	$path++;
}
//print_r($field);
echo $result;
?>