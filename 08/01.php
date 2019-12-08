<?php
error_reporting(0);
$lines = file("input.txt", FILE_IGNORE_NEW_LINES);
$image = array(array(array())); // [layer][x][y]
$width = 25;
$height = 6;
$line = str_split($lines[0]);
$pointer = 0;
$layer = 0;
while($pointer < count($line)){
    for($y=0;$y<$height;$y++){
        for($x=0;$x<$width;$x++){
            $image[$layer][$x][$y] = $line[$pointer++];
            
        }
    }
    $layer++;
}
$min_zeros = 25*6;
$answer = 0;
for($x=0;$x<$layer;$x++){
    $result = array();
    array_walk_recursive($image[$x],function($v) use (&$result){ $result[] = $v; });
    $result = array_count_values($result);
    if($min_zeros > $result[0]){
        $answer = $result;
        $min_zeros = $result[0];
    }
}
print_r($answer[1]*$answer[2]);

?>