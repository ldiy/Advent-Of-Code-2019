<?php
error_reporting(0);
$input = array(3,1033,1008,1033,1,1032,1005,1032,31,1008,1033,2,1032,1005,1032,58,1008,1033,3,1032,1005,1032,81,1008,1033,4,1032,1005,1032,104,99,101,0,1034,1039,101,0,1036,1041,1001,1035,-1,1040,1008,1038,0,1043,102,-1,1043,1032,1,1037,1032,1042,1105,1,124,102,1,1034,1039,101,0,1036,1041,1001,1035,1,1040,1008,1038,0,1043,1,1037,1038,1042,1105,1,124,1001,1034,-1,1039,1008,1036,0,1041,1002,1035,1,1040,1002,1038,1,1043,1001,1037,0,1042,1105,1,124,1001,1034,1,1039,1008,1036,0,1041,1002,1035,1,1040,101,0,1038,1043,101,0,1037,1042,1006,1039,217,1006,1040,217,1008,1039,40,1032,1005,1032,217,1008,1040,40,1032,1005,1032,217,1008,1039,35,1032,1006,1032,165,1008,1040,33,1032,1006,1032,165,1102,2,1,1044,1106,0,224,2,1041,1043,1032,1006,1032,179,1101,1,0,1044,1106,0,224,1,1041,1043,1032,1006,1032,217,1,1042,1043,1032,1001,1032,-1,1032,1002,1032,39,1032,1,1032,1039,1032,101,-1,1032,1032,101,252,1032,211,1007,0,27,1044,1105,1,224,1101,0,0,1044,1105,1,224,1006,1044,247,101,0,1039,1034,1002,1040,1,1035,101,0,1041,1036,1001,1043,0,1038,101,0,1042,1037,4,1044,1106,0,0,8,86,20,11,8,18,84,20,96,25,15,28,96,20,74,24,7,5,77,6,77,6,23,74,3,23,93,21,72,23,1,57,87,10,17,9,23,48,16,9,32,11,62,73,5,70,2,10,77,23,16,76,24,28,13,46,92,26,15,10,87,13,28,54,10,50,4,16,47,75,24,55,4,99,92,17,66,24,7,13,33,43,21,65,24,4,74,40,8,28,25,5,72,25,5,54,19,72,6,44,49,3,65,11,24,85,39,11,5,77,15,6,65,12,66,66,14,8,88,81,2,8,99,7,54,70,2,97,69,9,17,51,47,1,56,88,81,41,10,98,16,23,35,24,82,24,5,99,39,67,8,14,46,56,5,8,59,9,53,9,21,95,6,95,7,12,85,26,79,82,19,21,62,99,5,13,81,19,31,15,29,67,45,22,75,84,14,25,83,33,97,4,85,15,17,25,21,51,55,11,76,32,15,43,60,13,13,11,65,65,16,9,96,26,17,10,94,23,12,37,16,49,2,81,17,11,20,17,16,37,87,16,12,96,23,10,68,22,75,34,4,22,14,34,14,62,8,34,12,72,7,40,5,54,10,89,7,96,1,14,72,7,11,60,93,68,51,21,86,25,34,26,20,38,7,21,94,78,10,8,46,4,81,12,84,30,11,9,48,12,83,73,42,83,26,26,40,22,91,6,38,99,2,40,24,93,10,22,84,22,19,94,8,6,42,33,11,15,31,66,33,2,65,39,67,26,5,67,19,86,1,12,20,28,54,80,84,3,17,32,26,51,8,6,20,67,15,54,30,5,31,97,9,10,29,18,45,8,23,69,18,61,11,4,73,5,46,13,96,16,80,66,17,1,11,50,37,4,34,94,15,32,77,5,93,69,12,66,6,24,18,84,26,42,5,78,74,22,82,15,23,60,11,64,61,59,48,11,99,49,3,68,2,16,14,99,7,94,9,22,75,20,30,21,17,91,20,41,21,26,42,44,19,18,85,17,96,21,2,88,62,69,8,39,3,11,62,12,25,29,69,79,52,56,6,52,22,78,42,8,18,22,59,91,13,94,89,10,16,73,11,17,80,81,26,36,26,55,16,13,30,6,6,43,1,43,83,21,69,11,42,8,77,21,31,25,24,99,26,56,85,15,74,1,88,13,3,18,42,14,54,13,6,91,49,7,36,42,2,8,67,55,14,35,5,33,6,96,24,94,24,59,46,18,4,61,95,2,33,33,2,31,24,97,1,91,15,52,15,53,44,10,20,47,93,8,1,48,80,22,80,23,15,92,18,18,59,19,69,17,8,55,38,26,9,68,23,85,2,12,23,77,4,21,16,6,90,45,17,61,16,28,22,24,58,30,26,2,85,1,53,29,18,37,30,38,4,12,92,60,19,13,56,19,85,7,66,19,73,39,9,90,81,3,8,9,72,25,37,24,5,96,25,13,81,92,34,19,95,3,26,36,25,25,25,15,95,6,35,43,92,10,79,70,8,30,18,96,75,1,5,76,17,86,3,46,22,11,50,96,1,56,43,2,23,53,7,71,20,61,73,34,31,57,24,69,4,24,6,25,98,50,21,63,12,97,11,9,72,19,40,21,7,2,18,77,83,16,1,82,24,25,57,72,25,9,15,76,21,14,71,16,94,7,64,21,69,87,18,65,1,21,20,61,91,10,86,7,55,36,1,40,99,39,8,41,5,92,76,33,20,40,15,81,76,48,5,35,64,59,6,30,13,52,19,84,21,58,1,89,29,53,10,76,22,33,26,65,3,96,0,0,21,21,1,10,1,0,0,0,0,0,0);

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

function print_map(&$map, &$map_size,$r_x,$r_y){
    for($y = $map_size[3] + 1; $y >= $map_size[2]-1; $y--){
        for($x = $map_size[0]-1; $x <= $map_size[1]+1; $x++){      
            if($r_x == $x && $r_y == $y){
                echo "R";
            }
            elseif($map[$x][$y] == NULL){
                echo " ";
            }
            else{
                echo $map[$x][$y];
            }
            
        }
        echo PHP_EOL;
    }

}
$map = array(array());
$robot = new IntCode($input);
$modus = 1;  // 1 = north | 2= south | 3 = west | 4 = east 
$robot_x = 0;
$robot_y = 0;
$moves = array();
$oxy_x = 0;
$oxy_y = 0;
function get_av_modus($x,$y,$mod){
	global $map;
	$result = array();
	if($mod){
		if($map[$x][$y + 1] != "#" && $map[$x][$y + 1] != ".") array_push($result,1);
		if($map[$x][$y - 1] != "#" && $map[$x][$y - 1] != ".") array_push($result,2);
		if($map[$x + 1][$y] != "#" && $map[$x + 1][$y] != ".") array_push($result,4);
		if($map[$x - 1][$y] != "#" && $map[$x -1][$y] != ".") array_push($result,3);
	}
	else{
		if($map[$x][$y + 1] != "#" && $map[$x][$y + 1] != "D") array_push($result,1);
		if($map[$x][$y - 1] != "#" && $map[$x][$y - 1] != "D") array_push($result,2);
		if($map[$x + 1][$y] != "#" && $map[$x + 1][$y] != "D") array_push($result,4);
		if($map[$x - 1][$y] != "#" && $map[$x - 1][$y] != "D") array_push($result,3);
	}
	return $result;
}

$map_size = array(1000000,0,1000000,0); // min x, max x, min y, max y
$wall = false;
while(true){
     array_push($moves,$modus);
    //echo "x: " . $robot_x . "|y: " . $robot_y . PHP_EOL;
   // echo "modus: " . $modus . PHP_EOL;
    $map_size = array(min($map_size[0],$robot_x - 1), max($map_size[1],$robot_x + 1) , min($map_size[2],$robot_y - 1), max($map_size[3],$robot_x + 1));
    

    array_push($robot->inputBuffer,$modus);
    $status = $robot->run();
    $result = $robot->outputBuffer[$robot->outputBufferPointer-1];
    if($result == 2 || $status == 1){
		echo "done";
		$oxy_x = $robot_x;
		$oxy_y = $robot_y;
		$result = 1;
        //break;
	}
	
    if($result == 1){
        if($modus == 1) { $map[$robot_x][$robot_y ] = ".";$robot_y++; }
        if($modus == 2) { $map[$robot_x][$robot_y ] = ".";$robot_y--; }
        if($modus == 3) { $map[$robot_x ][$robot_y] = ".";$robot_x--; }
        if($modus == 4) { $map[$robot_x ][$robot_y] = ".";$robot_x++; }
        $wall = false;
    }
    elseif($result == 0){
        //echo "wall" .  PHP_EOL;
        if($modus == 1) { $map[$robot_x][$robot_y + 1] = "#"; } 
        elseif($modus == 2) { $map[$robot_x][$robot_y - 1] = "#";  }
        elseif($modus == 3) { $map[$robot_x - 1][$robot_y] = "#";  }
        elseif($modus == 4) { $map[$robot_x + 1][$robot_y] = "#";  }
		

		//get_av_modus();

		if($modus == 1) $modus = 4;
        elseif($modus == 2) $modus = 3;
        elseif($modus == 3) $modus = 1;
		elseif($modus == 4)	$modus = 2;
	}
	
    //echo "next.. " . PHP_EOL;
	//print_r($map_size);
	if(count($moves)%100000 == 0){
		print_map($map,$map_size, $robot_x, $robot_y);
		$in = readline("next");
		if($in == "s")
			break;
	}
	$options = get_av_modus($robot_x,$robot_y,1);
	//echo "options";
	//print_r($options);
	
	if(count($options) != 0){
		$modus = $options[0];
	}
	else{
		$options = get_av_modus($robot_x,$robot_y,0);
		$modus = $options[rand(0,count($options) - 1)];
		//print_r($moves);
		//readline("n");
	}
	//echo "chosen:  " . $modus . PHP_EOL;
    //$test = readline("in: ");/*
    
}
$map[$oxy_x][$oxy_y] = "Z";
$map[0][0] = "O";
print_map($map,$map_size, $robot_x, $robot_y);
$cur_x = 0;
$cur_y = 0;
$done = false;
$answer = 0;
while(!$done){
	if($map[$cur_x][$cur_y] == "Z") break;
	$av_moves = get_av_modus($cur_x,$cur_y,0);
	if(count($av_moves) == 1){
		$modus = $av_moves[0];
		
	}else{
		print_map($map,$map_size, $cur_x, $cur_y);
		print_r($av_moves);
		$modus = readline("modus: ");
	}

	$map[$cur_x][$cur_y] = "D";
	if($modus == 1) $cur_y++;
    if($modus == 2) $cur_y--;
    if($modus == 3) $cur_x--;
    if($modus == 4) $cur_x++;
	$answer++;
}
echo $answer + 1 . PHP_EOL;

?>