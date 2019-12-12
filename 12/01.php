<?php
Class Moon{
    public function __construct($x,$y,$z) {
        $this->xPos = $x;
        $this->yPos = $y;
        $this->zPos = $z;

        $this->xVel = 0;
        $this->yVel = 0;
        $this->zVel = 0;
        
        $this->ek = 0;
        $this->ep = 0;

    }

    function updatePos(){
        $this->xPos += $this->xVel;
        $this->yPos += $this->yVel;
        $this->zPos += $this->zVel;
    }

    function echoPos(){
        echo $this->xPos . PHP_EOL;
        echo $this->yPos . PHP_EOL;
        echo $this->zPos . PHP_EOL;
        echo "______________" . PHP_EOL;
    }

    function calcEnery(){
        $this->ep = abs($this->xPos) + abs($this->yPos) + abs($this->zPos);
        $this->ek = abs($this->xVel) + abs($this->yVel) + abs($this->zVel);
        return($this->ep * $this->ek);
    }

}

/*
<x=-13, y=-13, z=-13>
<x=5, y=-8, z=3>
<x=-6, y=-10, z=-3>
<x=0, y=5, z=-5>
*/

$moons = array();

array_push($moons,new Moon(-13,-13,-13));
array_push($moons,new Moon(5,-8,3));
array_push($moons,new Moon(-6,-10,-3));
array_push($moons,new Moon(0,5,-5));
for($i=0;;$i++){
    $moonsDone = array();
    foreach($moons as $moon){
        array_push($moonsDone, $moon);
        foreach($moons as $_moon){
            $bool  = in_array($_moon,$moonsDone);
            if(in_array($_moon,$moonsDone) == false){
                if($_moon->xPos > $moon->xPos){ $_moon->xVel -= 1; $moon->xVel += 1;}
                elseif($_moon->xPos < $moon->xPos){ $_moon->xVel += 1; $moon->xVel -= 1; }

                if($_moon->yPos > $moon->yPos){ $_moon->yVel -= 1; $moon->yVel += 1;}
                elseif($_moon->yPos < $moon->yPos){ $_moon->yVel += 1; $moon->yVel -= 1;}

                if($_moon->zPos > $moon->zPos){ $_moon->zVel -= 1; $moon->zVel += 1;}
                elseif($_moon->zPos < $moon->zPos){ $_moon->zVel += 1; $moon->zVel -= 1;}
            }
        }
        $moon->updatePos();
        //$moon->echoPos();
    }
    echo $i . PHP_EOL;
}

$result = 0;
foreach($moons as $moon){
    $result += $moon->calcEnery();
}
echo $result;
?>