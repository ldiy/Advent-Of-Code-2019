<?php
//error_reporting(0);
$lines = file("input.txt", FILE_IGNORE_NEW_LINES);
$imageLayers = array(array(array())); // [layer][x][y]
$width = 25;
$height = 6;
$line = str_split($lines[0]);
$pointer = 0;
$layer = 0;
while($pointer < count($line)){
    for($y=0;$y<$height;$y++){
        for($x=0;$x<$width;$x++){
            $imageLayers[$layer][$x][$y] = $line[$pointer++];
        }
    }
    $layer++;
}

/* convert to 1 layer */
$image = $imageLayers[0]; // same size
for($y=0;$y<$height;$y++){
    for($x=0;$x<$width;$x++){
        $currentLayer = 0;
        while($imageLayers[$currentLayer][$x][$y] == 2)
            $currentLayer++;
        $image[$x][$y] = $imageLayers[$currentLayer][$x][$y];
    }
}

/* print */
for($y=0;$y<$height;$y++){
    for($x=0;$x<$width;$x++){
        if(!$image[$x][$y])
            echo(" ");
        else           
            echo $image[$x][$y];
    }
    echo PHP_EOL;
}

?>