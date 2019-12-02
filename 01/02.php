<?php
function calc_extra_fuel($in){
	if($in <= 0)
		return(0);
	else
		return($in + calc_extra_fuel(floor($in / 3) -2));
}

$lines = file("input.txt", FILE_IGNORE_NEW_LINES);
$sum = 0;

foreach($lines as $line){
	$fneeded = floor($line / 3) - 2;
	$sum +=  calc_extra_fuel($fneeded);
}
echo $sum;
?>