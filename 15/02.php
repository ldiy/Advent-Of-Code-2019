<?php
error_reporting(0);
$lines = file("map.txt", FILE_IGNORE_NEW_LINES);
$map = array(array());
$y = 0;
$oxy_y = 0;
$oxy_x = 0;
foreach($lines as $line){
    $cols = str_split($line);
    for($x=0;$x<count($cols); $x++){
        $map[$x][$y] = $cols[$x];
        if($cols[$x] == "Z"){
            $oxy_y = $y;
            $oxy_x = $x;
        }
    }
    $y++;
}


function print_map(&$map){
    for($y = 0; $y < count($map); $y++){
        for($x = 0; $x < count($map[0]); $x++){      
                echo $map[$x][$y];       
        }
        echo PHP_EOL;
    }

}

$map2 = $map;
$done = false;
$result = 0;
while(!$done){
    $done = true;
    for($y = 0; $y< count($map); $y++){
        for($x = 0; $x < count($map[0]); $x++){
            if($map[$x][$y] == ".") $done = false;
            if($map[$x][$y] == "Z"){
                if($map[$x+1][$y] != "#") $map2[$x+1][$y] = "Z";
                if($map[$x-1][$y] != "#") $map2[$x-1][$y] = "Z";
                if($map[$x][$y+1] != "#") $map2[$x][$y+1] = "Z";
                if($map[$x][$y-1] != "#") $map2[$x][$y-1] = "Z";
            }
        }
    }
    $map = $map2;
    $result++;
}
print_map($map);
echo $result;
?>