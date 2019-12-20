<?php
error_reporting(0);
$input = array(109,424,203,1,21102,11,1,0,1105,1,282,21102,1,18,0,1105,1,259,1201,1,0,221,203,1,21101,0,31,0,1105,1,282,21102,38,1,0,1106,0,259,21001,23,0,2,22101,0,1,3,21101,0,1,1,21102,1,57,0,1105,1,303,2101,0,1,222,21001,221,0,3,20102,1,221,2,21102,259,1,1,21101,80,0,0,1106,0,225,21101,0,111,2,21102,1,91,0,1105,1,303,2102,1,1,223,20101,0,222,4,21102,1,259,3,21102,1,225,2,21102,1,225,1,21101,0,118,0,1105,1,225,20101,0,222,3,21102,148,1,2,21102,1,133,0,1106,0,303,21202,1,-1,1,22001,223,1,1,21102,148,1,0,1106,0,259,2101,0,1,223,20102,1,221,4,21001,222,0,3,21101,0,17,2,1001,132,-2,224,1002,224,2,224,1001,224,3,224,1002,132,-1,132,1,224,132,224,21001,224,1,1,21101,0,195,0,106,0,109,20207,1,223,2,20102,1,23,1,21102,-1,1,3,21101,0,214,0,1105,1,303,22101,1,1,1,204,1,99,0,0,0,0,109,5,2102,1,-4,249,22101,0,-3,1,21202,-2,1,2,21202,-1,1,3,21102,1,250,0,1105,1,225,22102,1,1,-4,109,-5,2106,0,0,109,3,22107,0,-2,-1,21202,-1,2,-1,21201,-1,-1,-1,22202,-1,-2,-2,109,-3,2105,1,0,109,3,21207,-2,0,-1,1206,-1,294,104,0,99,22102,1,-2,-2,109,-3,2106,0,0,109,5,22207,-3,-4,-1,1206,-1,346,22201,-4,-3,-4,21202,-3,-1,-1,22201,-4,-1,2,21202,2,-1,-1,22201,-4,-1,1,21202,-2,1,3,21101,0,343,0,1105,1,303,1105,1,415,22207,-2,-3,-1,1206,-1,387,22201,-3,-2,-3,21202,-2,-1,-1,22201,-3,-1,3,21202,3,-1,-1,22201,-3,-1,2,21201,-4,0,1,21102,384,1,0,1106,0,303,1105,1,415,21202,-4,-1,-4,22201,-4,-3,-4,22202,-3,-2,-2,22202,-2,-4,-4,22202,-3,-2,-3,21202,-4,-1,-2,22201,-3,-2,1,21202,1,1,-4,109,-5,2106,0,0);

class IntCode{
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

			/* add leading 0 if needed*/ 
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
function check($x,$y){
    global $input;
    $drone = new IntCode($input);
    array_push($drone->inputBuffer,$x);
    array_push($drone->inputBuffer,$y);
    $drone->run();
    return($drone->outputBuffer[count($drone->outputBuffer)-1]);
}


$field = array(array());
$prev_min_x = 0;
$prev_max_x = 50;

for($y=20;;$y++){
    $go = true;
    $first_x = false;
    $x_c = 0;

    for($x= $prev_max_x + 10;;$x--){
        if(check($x,$y)){
            if($x >= 100){
                if(check($x-99,$y) && check($x,$y+99) && check($x-99,$y+99)){
                    echo "x: " . $x-99 . " | y: " . $y . PHP_EOL;
                    $go = false;
                    break;
                }
            }
            $prev_max_x = $x;
            break;
        }
    }
    
    if($go == false) break;
    echo $y . PHP_EOL;
}
echo $result;
?>