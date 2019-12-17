<?php
error_reporting(0);
$lines = file("map.txt", FILE_IGNORE_NEW_LINES);
$map = array(array());
$y = 0;
foreach($lines as $line){
    $cols = str_split($line);
    for($x=0;$x<count($cols); $x++){
        $map[$x][$y] = $cols[$x];
    }
    $y++;
}
print_r($map)
?>