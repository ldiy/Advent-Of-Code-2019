<?php
Class Moon{
    public function __construct($x,$y,$z) {
        $this->initX = $x;
        $this->initY = $y;
        $this->initZ = $z;

        $this->xPos = $x;
        $this->yPos = $y;
        $this->zPos = $z;

        $this->xVel = 0;
        $this->yVel = 0;
        $this->zVel = 0;
    }

    function updatePos(){
        $this->xPos += $this->xVel;
        $this->yPos += $this->yVel;
        $this->zPos += $this->zVel;
    }
}

/*
INPUT:
<x=-13, y=-13, z=-13>
<x=5, y=-8, z=3>
<x=-6, y=-10, z=-3>
<x=0, y=5, z=-5>

*/

$moons = array();

/* TODO: read input from file */
array_push($moons,new Moon(-13,-13,-13));
array_push($moons,new Moon(5,-8,3));
array_push($moons,new Moon(-6,-10,-3));
array_push($moons,new Moon(0,5,-5));

$xCycle = 0;
$yCycle = 0;
$zCycle = 0;
for($i=0;;$i++){
    $moonsDone = array();
    foreach($moons as $moon){       
        array_push($moonsDone, $moon);
        foreach($moons as $_moon){
            if(in_array($_moon,$moonsDone) == false){
                if($_moon->xPos > $moon->xPos){ $_moon->xVel -= 1; $moon->xVel += 1;}
                elseif($_moon->xPos < $moon->xPos){ $_moon->xVel += 1; $moon->xVel -= 1; }

                if($_moon->yPos > $moon->yPos){ $_moon->yVel -= 1; $moon->yVel += 1;}
                elseif($_moon->yPos < $moon->yPos){ $_moon->yVel += 1; $moon->yVel -= 1; }

                if($_moon->zPos > $moon->zPos){ $_moon->zVel -= 1; $moon->zVel += 1;}
                elseif($_moon->zPos < $moon->zPos){ $_moon->zVel += 1; $moon->zVel -= 1; }
            }
        }
        $moon->updatePos();        
    }
    $xcycleComplete = true;
    $ycycleComplete = true;
    $zcycleComplete = true;
    foreach($moons as $moon){       
        if($moon->xPos != $moon->initX || $moon->xVel != 0)
            $xcycleComplete = false;
        if($moon->yPos != $moon->initY || $moon->yVel != 0)
            $ycycleComplete = false;
        if($moon->zPos != $moon->initZ || $moon->zVel != 0)
            $zcycleComplete = false;
    }
    if($xcycleComplete && $xCycle ==0 )
        $xCycle = $i;
    if($ycycleComplete  && $yCycle ==0)
        $yCycle = $i;
    if($zcycleComplete  && $zCycle ==0)
        $zCycle = $i;

    if($xCycle != 0 && $yCycle != 0 && $zCycle != 0)
        break;

}

function gcd($a, $b) 
{ 
    if ($b == 0) 
        return $a; 
    return gcd($b, $a % $b); 
} 
  
// Returns LCM of array elements 
function findlcm($arr, $n) 
{ 
    $ans = $arr[0]; 
    for ($i = 1; $i < $n; $i++) 
        $ans = ((($arr[$i] * $ans)) / 
                (gcd($arr[$i], $ans))); 
  
    return $ans; 
} 

$result = array($xCycle+1,$yCycle+1,$zCycle+1);
echo findlcm($result,count($result));
?>