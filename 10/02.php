<?php
$lines = file("input.txt", FILE_IGNORE_NEW_LINES);
$xSize = 0;
$ySize = 0;
/* read all coordinates */
function mapToCoordinates($in,&$ySize,&$xSize,&$map){
    $coord = array();
    $temp = array(0,0,0,1); // x, y, angle, active
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
            if($a != $i){
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
    return(sqrt(pow(($x2-$x1),2) + pow(($y2-$y1),2)));
}

$map = array(array());
$coordinates = mapToCoordinates($lines,$ySize,$xSize,$map);
$xLaser = 0;
$yLaser = 0;
bestAsteroid($xLaser,$yLaser,$coordinates);



for($i = 0; $i < count($coordinates); $i++){
    $corX = $coordinates[$i][0];
    $corY = $coordinates[$i][1];

    $relX = $corX-$xLaser;
    $relY = $corY-$yLaser;

    $angle = atan2($relX,-1*$relY) * 180 / pi();
    if($angle < 0)
        $angle += 360;
    
    $coordinates[$i][2] = $angle;
}

usort($coordinates, function($a, $b) {
    return $a[2] <=> $b[2];
});


$count = 0;
$done = true;
while($done){
    $prevAngle = 0;
    $min = 100000;
    $minI = 0;
    for($i = 0; $i < count($coordinates); $i++)
    {
        if($coordinates[$i][3] == 1)
        {
            $x1 = $coordinates[$i][0]; //x
            $y1 = $coordinates[$i][1]; //y
            $angle1 = $coordinates[$i][2];

                $dis = calcDistance($x1,$y1,$xLaser,$yLaser);
                if($min > $dis)
                {
                    $min = $dis;
                    $minI = $i;
                }

            if($coordinates[$i][2] != $coordinates[$i+1][2])
            {
                $coordinates[$minI][3] = 0; // Inactive
                
                $min = 10000;
                $count++;
                if($count == 200){
                    echo "x: " . $x1 . " y: " . $y1 . PHP_EOL;
                    echo "result: " . (string)($x1*100+$y1) . PHP_EOL;
                    $done = false;
                break;
                }
            }
            $prevAngle = $angle1;
        }
    }
}

?>