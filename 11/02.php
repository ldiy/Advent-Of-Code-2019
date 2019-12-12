<?php
error_reporting(0);
$input = array(3,8,1005,8,337,1106,0,11,0,0,0,104,1,104,0,3,8,102,-1,8,10,101,1,10,10,4,10,1008,8,1,10,4,10,101,0,8,29,3,8,1002,8,-1,10,101,1,10,10,4,10,1008,8,0,10,4,10,102,1,8,51,1,1008,18,10,3,8,102,-1,8,10,1001,10,1,10,4,10,108,1,8,10,4,10,102,1,8,76,1006,0,55,1,1108,6,10,1,108,15,10,3,8,102,-1,8,10,1001,10,1,10,4,10,1008,8,1,10,4,10,101,0,8,110,2,1101,13,10,1,101,10,10,3,8,102,-1,8,10,1001,10,1,10,4,10,108,0,8,10,4,10,1001,8,0,139,1006,0,74,2,107,14,10,1,3,1,10,2,1104,19,10,3,8,1002,8,-1,10,1001,10,1,10,4,10,1008,8,1,10,4,10,1002,8,1,177,2,1108,18,10,2,1108,3,10,1,109,7,10,3,8,1002,8,-1,10,1001,10,1,10,4,10,108,0,8,10,4,10,101,0,8,210,1,1101,1,10,1,1007,14,10,2,1104,20,10,3,8,102,-1,8,10,1001,10,1,10,4,10,108,0,8,10,4,10,102,1,8,244,1,101,3,10,1006,0,31,1006,0,98,3,8,102,-1,8,10,1001,10,1,10,4,10,1008,8,1,10,4,10,1002,8,1,277,1006,0,96,3,8,1002,8,-1,10,101,1,10,10,4,10,1008,8,0,10,4,10,1002,8,1,302,1,3,6,10,1006,0,48,2,101,13,10,2,2,9,10,101,1,9,9,1007,9,1073,10,1005,10,15,99,109,659,104,0,104,1,21101,937108976384,0,1,21102,354,1,0,1105,1,458,21102,1,665750077852,1,21101,0,365,0,1105,1,458,3,10,104,0,104,1,3,10,104,0,104,0,3,10,104,0,104,1,3,10,104,0,104,1,3,10,104,0,104,0,3,10,104,0,104,1,21101,21478178856,0,1,21101,412,0,0,1105,1,458,21102,3425701031,1,1,21102,1,423,0,1106,0,458,3,10,104,0,104,0,3,10,104,0,104,0,21102,984458351460,1,1,21102,1,446,0,1105,1,458,21101,0,988220908388,1,21101,457,0,0,1105,1,458,99,109,2,22101,0,-1,1,21102,1,40,2,21101,489,0,3,21101,479,0,0,1105,1,522,109,-2,2106,0,0,0,1,0,0,1,109,2,3,10,204,-1,1001,484,485,500,4,0,1001,484,1,484,108,4,484,10,1006,10,516,1102,0,1,484,109,-2,2105,1,0,0,109,4,1201,-1,0,521,1207,-3,0,10,1006,10,539,21102,1,0,-3,21201,-3,0,1,21202,-2,1,2,21101,1,0,3,21101,558,0,0,1105,1,563,109,-4,2105,1,0,109,5,1207,-3,1,10,1006,10,586,2207,-4,-2,10,1006,10,586,22102,1,-4,-4,1106,0,654,21202,-4,1,1,21201,-3,-1,2,21202,-2,2,3,21102,1,605,0,1106,0,563,21201,1,0,-4,21102,1,1,-1,2207,-4,-2,10,1006,10,624,21102,1,0,-1,22202,-2,-1,-2,2107,0,-3,10,1006,10,646,22101,0,-1,1,21102,646,1,0,106,0,521,21202,-2,-1,-2,22201,-4,-2,-4,109,-5,2106,0,0);

class intCode{
	public function __construct($program) {
		$this->program = $program;
        $this->inputBuffer = array();
        $this->outputBuffer = array();
		$this->pointer = 0;
        $this->inputBufferPointer = 0;
        $this->outputBufferPointer = 0;
        $this->relBase = 0;
	}	
	function run(){
		$len = count($this->program);
		//while($this->pointer < $len){
        while(true){
			$instruction = str_split($this->program[$this->pointer]); // mode's and opcode
			$instrSize = count($instruction);
			$parameters = array(0,0,0);				// location of parameters
            if($instruction[$instrSize - 2] != NULL)
                $opcode = $instruction[$instrSize - 2] . $instruction[$instrSize - 1];
            else
				$opcode = "0" . $instruction[$instrSize - 1];
				
			/* check for halt opcode */
			if($opcode == "99")
				return 1;

			/* add leading 0's if needed*/ 
			for($i = 0; $i<=2; $i++){
				if($instrSize - 3 - $i >= 0)
					$parameters[2-$i] = $instruction[$instrSize - 3 - $i];
				else
					$parameters[2-$i] = 0;
			}		
			/* check if parameter mode is 1 or 0*/
			for($i = 0; $i <= 2; $i++){
				if($parameters[$i] == 0 && $this->pointer + 3 - $i < count($this->program))								// mode = 1
					$parameters[$i] = $this->program[$this->pointer + 3 - $i];
				else if($parameters[$i] == 1)							// mode = 2
                    $parameters[$i] = $this->pointer + 3 - $i;
                else if($parameters[$i] == 2)							// mode = 2
                    $parameters[$i] = $this->relBase + $this->program[$this->pointer + 3 - $i];
			}
			
			/* extract opcode from instruction */		
			
			/* for readability */
			$P1 = $parameters[2];
			$P2 = $parameters[1];
			$P3 = $parameters[0];
			
			/* handle opcodes */
			/* add */
			if($opcode == "01"){ 
				$this->program[$P3] = $this->program[$P1] + $this->program[$P2];
				$this->pointer += 4;
			}
			/* multiply */
			elseif($opcode == "02"){
				$this->program[$P3] = $this->program[$P1] * $this->program[$P2];				
				$this->pointer += 4;
			}
			/* input */
			elseif($opcode == "03"){
				if($this->inputBufferPointer < count($this->inputBuffer))
					$this->program[$P1] = $this->inputBuffer[$this->inputBufferPointer];
				else
					return 0;

				$this->inputBufferPointer++;
                $this->pointer += 2;
			}
			/* output */
			elseif($opcode == "04"){
                array_push($this->outputBuffer,$this->program[$P1]);
                $this->outputBufferPointer++;
                $this->pointer += 2;
			}
			/* jump if true */
			elseif($opcode == "05"){
				if($this->program[$P1] != 0)
					$this->pointer = $this->program[$P2];
				else
					$this->pointer += 3;
			}
			/* jump if false */
			elseif($opcode == "06"){
				if($this->program[$P1] == 0)
					$this->pointer = $this->program[$P2];
				else
					$this->pointer += 3;
			} 
			/* less than */
			elseif($opcode == "07"){
				if($this->program[$P1] < $this->program[$P2])
					$this->program[$P3] = 1;
				else
					$this->program[$P3] = 0;
				$this->pointer += 4;
			}
			/* equeals */
			elseif($opcode == "08"){
				if($this->program[$P1] == $this->program[$P2])
					$this->program[$P3] = 1;
				else
					$this->program[$P3]= 0;
				$this->pointer += 4;
            }
            /* relBase update */
	        elseif($opcode == "09"){
		        $this->relBase += $this->program[$P1];
		        $this->pointer += 2;
	        }
			/* opcode not found */
			else{
				echo "error 02 " . PHP_EOL . $opcode . PHP_EOL;
				break;
			}
		}
	}
}


$robot = new intCode($input);
$field = array(array());
$curX = 0;
$curY = 0;
$mode = 0;  // 0 = ^  |  1 = >  |   2 = v  |   3 = <


$field[0][0] = 1;
$maxX = 0;
$maxY = 0;
$minX = 0;
$minY = 0;

while(true){
    $maxX = max($maxX,$curX);
    $maxY = max($maxY,$curY);
    $minX = min($minX,$curX);
	$minY = min($minY,$curY);
	
	/* give input */
	$currentColor = $field[$curX][$curY];
    if($currentColor == NULL)
        $currentColor = 0;  // black

    array_push($robot->inputBuffer,$currentColor);

    /* run until input buffer is clear */
    if($robot->run())
        break;
    
    /* get outputs */
    $currentColor = $robot->outputBuffer[$robot->outputBufferPointer - 2]; // 0 = black | 1 = white
    $turn = $robot->outputBuffer[$robot->outputBufferPointer - 1];         // 0 = left  | 1 = right
    
    /* paint color on field */
    $field[$curX][$curY] = $currentColor;

    /* turn and move forward */
    if($turn)
        $mode += 1;
    else
        $mode -= 1;

    if($mode == 4)  $mode = 0;
    if($mode == -1) $mode = 3;
    
    if($mode == 0) $curY++; // up
    if($mode == 1) $curX++; // right
    if($mode == 2) $curY--; // down
    if($mode == 3) $curX--; // left

    
}

/* print */
for($y = $maxY; $y>=$minY;$y--){
    for($x = $minX; $x<$maxX;$x++){
        $color = $field[$x][$y];
        if($color == "0" || $color == NULL)
            $color = " ";
        else
            $color = "#";
        echo $color;
    }
    echo PHP_EOL;
}
?>