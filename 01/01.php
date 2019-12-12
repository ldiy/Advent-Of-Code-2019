<?php
$lines = file("input.txt", FILE_IGNORE_NEW_LINES);
$sum = 0;
foreach($lines as $line)
	$sum += floor($line / 3) - 2;
echo $sum;