<?php
$lines = file("input.txt", FILE_IGNORE_NEW_LINES);
$coordinates = array();
$temp = array(0,0); // x, y
$x=0;
$y=0;
foreach($lines as $line){
    $chars = str_split($line);
    foreach($chars as $char){
        if($char == "#"){
            $temp[0] = $x;
            $temp[1] = $y;
            array_push($coordinates,$temp);
        }
        $x++;
    }
    $x = 0;
    $y++;
}
$result = 0;
for($i = 0; $i < count($coordinates); $i++){
    $x1 = $coordinates[$i][0]; //x
    $y1 = $coordinates[$i][1]; //y
    $count = 0;
    for($a = 0; $a < count($coordinates); $a++){
        if($a != $i){
            $x2 = $coordinates[$a][0]; //x
            $y2 = $coordinates[$a][1]; //y
            $ok = true;
            for($b = 0; $b < count($coordinates); $b++){
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
    $result = max($result,$count);
}
echo $result;
?>