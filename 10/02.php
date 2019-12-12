<?php
$lines = file("input.txt", FILE_IGNORE_NEW_LINES);
$xSize = 0;
$ySize = 0;
/* read all coordinates */
function mapToCoordinates($in,&$ySize,&$xSize,&$map){
    $coord = array();
    $temp = array(0,0); // x, y
    $x=0;
    $y=0;
    foreach($in as $line){
        $chars = str_split($line);
        foreach($chars as $char){
            if($char == "#"){
                $temp[0] = $x;
                $temp[1] = $y;
                array_push($coord,$temp);
            }
            $map[$x][$y] = $char;
            $x++;
        }
        $xSize = $x-1;
        $x = 0;
        $y++;
    }
    $ySize = $y-1;
    return($coord);
}

/* determine the best asteroid */
function bestAsteroid(&$xCoord,&$yCoord, $coordinates){
    $result = 0;
    for($i = 0; $i < count($coordinates); $i++){            // pick an asteroid
        $x1 = $coordinates[$i][0]; //x
        $y1 = $coordinates[$i][1]; //y
        $count = 0;
        for($a = 0; $a < count($coordinates); $a++){        // check all other asteroids
            $x2 = $coordinates[$a][0]; //x
            $y2 = $coordinates[$a][1]; //y
            $ok = true;
            for($b = 0; $b < count($coordinates); $b++){    // check if an asteroid is in between
                if($a != $b && $b != $i){
                    $x = $coordinates[$b][0]; //x
                    $y = $coordinates[$b][1]; //y 
                    if($x2 == $x1){
                        if((( $y1 < $y  && $y < $y2) || ( $y1 > $y  && $y > $y2) ) && $x == $x1)
                            $ok = false;                     
                    }
                    elseif($y-$y1 == (($y2-$y1)/($x2-$x1))*($x-$x1)){
                        if(( $y1 < $y  && $y < $y2) || ( $y1 > $y  && $y > $y2) || ( $x1 > $x  && $x > $x2) || ( $x1 < $x  && $x < $x2))
                            $ok = false;
                    }
                }
            }
            if($ok)
                $count++;
        }
        if($result < $count){
            $result = $count;
            $xCoord = $x1;
            $yCoord = $y1;
        }
    }
}

function checkIfCoordIsBetween($x,$y,$x1,$y1,$x2,$y2){
    $ok = true;
    if($x2 == $x1){
        if((( $y1 < $y  && $y < $y2) || ( $y1 > $y  && $y > $y2) ) && $x == $x1)
            $ok = false;                     
    }
    elseif($y-$y1 == (($y2-$y1)/($x2-$x1))*($x-$x1)){
        if(( $y1 < $y  && $y < $y2) || ( $y1 > $y  && $y > $y2) || ( $x1 > $x  && $x > $x2) || ( $x1 < $x  && $x < $x2))
            $ok = false;
    }
    return(!$ok); 
}
/* Calc distance between 2 points */
function calcDistance($x1,$y1,$x2,$y2){
    return(sqrt(($x2-$x1)^2 + ($y2-$y1)^2));
}
$map = array(array());
$coordinatesList = mapToCoordinates($lines,$ySize,$xSize,$map);
print_r($map);

$xLaser = 0;
$yLaser = 0;
bestAsteroid($xLaser,$yLaser,$coordinatesList);
echo calcDistance(5,3,6,3);
$curX = $xLaser;
$curY = 0;
$mode = 0;
for($i=0;$i<(2*$xSize+2*$ySize);$i++){
    if($mode == 0){ 
        if($curX < $xSize)
            $curX++;
        else
            $mode++;

        $min = count($coordinates);
        $xmin = 0;
        $ymin = 0;
        for($i = 0; $i < count($coordinates); $i++){
            $x1 = $coordinates[$i][0]; //x
            $y1 = $coordinates[$i][1]; //y
            if(checkIfCoordIsBetween($x1,$y1,$xLaser,$yLaser,$curX,$curY)){
                $dis = calcDistance($x1,$y1,$xLaser,$yLaser);
                if($min > $dis && ){
                    $min = $dis;
                    $curY = $y1;
                    $curX = $x1;
                }
            }
            
        }
    }
    if($mode == 1){
        if($curY < $ySize)
            $curY++;
        else
            $mode++;
    }
    if($mode == 2){
        if($curX > 0)
            $curX--;
        else
            $mode++;
    }
    if($mode == 3){
        if($curY > 0)
            $curY--;
        else
            $mode = 0;
    }


}
?>