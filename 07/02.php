<?php
$input = array(3,8,1001,8,10,8,105,1,0,0,21,42,63,76,101,114,195,276,357,438,99999,3,9,101,2,9,9,102,5,9,9,1001,9,3,9,1002,9,5,9,4,9,99,3,9,101,4,9,9,102,5,9,9,1001,9,5,9,102,2,9,9,4,9,99,3,9,1001,9,3,9,1002,9,5,9,4,9,99,3,9,1002,9,2,9,101,5,9,9,102,3,9,9,101,2,9,9,1002,9,3,9,4,9,99,3,9,101,3,9,9,102,2,9,9,4,9,99,3,9,1001,9,2,9,4,9,3,9,102,2,9,9,4,9,3,9,101,2,9,9,4,9,3,9,102,2,9,9,4,9,3,9,101,1,9,9,4,9,3,9,1001,9,2,9,4,9,3,9,1001,9,1,9,4,9,3,9,1001,9,2,9,4,9,3,9,1001,9,2,9,4,9,3,9,1001,9,1,9,4,9,99,3,9,102,2,9,9,4,9,3,9,1001,9,2,9,4,9,3,9,102,2,9,9,4,9,3,9,1002,9,2,9,4,9,3,9,1001,9,1,9,4,9,3,9,102,2,9,9,4,9,3,9,1002,9,2,9,4,9,3,9,102,2,9,9,4,9,3,9,1002,9,2,9,4,9,3,9,102,2,9,9,4,9,99,3,9,102,2,9,9,4,9,3,9,102,2,9,9,4,9,3,9,1002,9,2,9,4,9,3,9,1001,9,2,9,4,9,3,9,1002,9,2,9,4,9,3,9,1001,9,1,9,4,9,3,9,1002,9,2,9,4,9,3,9,1002,9,2,9,4,9,3,9,101,2,9,9,4,9,3,9,1001,9,2,9,4,9,99,3,9,1001,9,1,9,4,9,3,9,101,2,9,9,4,9,3,9,102,2,9,9,4,9,3,9,1001,9,2,9,4,9,3,9,1001,9,1,9,4,9,3,9,102,2,9,9,4,9,3,9,1001,9,2,9,4,9,3,9,1001,9,2,9,4,9,3,9,102,2,9,9,4,9,3,9,1001,9,2,9,4,9,99,3,9,102,2,9,9,4,9,3,9,101,1,9,9,4,9,3,9,1002,9,2,9,4,9,3,9,1002,9,2,9,4,9,3,9,1002,9,2,9,4,9,3,9,101,2,9,9,4,9,3,9,1001,9,2,9,4,9,3,9,101,2,9,9,4,9,3,9,1002,9,2,9,4,9,3,9,101,2,9,9,4,9,99);
class amp{
	public function __construct($program,$phaseSetting) {
		$this->program = $program;
		$this->phaseSetting = $phaseSetting;
		$this->inputBuffer = array();
		$this->pointer = 0;
		$this->inputBufferPointer = 0;
	}	
	public $nextAmp;
	function amp(){
		$len = count($this->program);
		while($this->pointer < $len){
			$instruction = str_split($this->program[$this->pointer]); // mode's and opcode
			$instrSize = count($instruction);
			$parameters = array(0,0,0);				// location of parameters
			
			/* add leading 0 if needed*/ 
			for($i = 0; $i<=2; $i++){
				if($instrSize - 3 - $i >= 0)
					$parameters[2-$i] = $instruction[$instrSize - 3 - $i];
				else
					$parameters[2-$i] = 0;
			}		
			/* check if parameter mode is 1 or 0*/
			for($i = 0; $i <= 2; $i++){
				if($parameters[$i] == 0)								// mode = 1
					$parameters[$i] = $this->program[$this->pointer + 3 - $i];
				else if($parameters[$i] == 1)							// mode = 2
					$parameters[$i] = $this->pointer + 3 - $i;
				else
					echo "error 01 para: " . $parameters[$i] . PHP_EOL;	// invalid parameter mode
			}
			
			/* extract opcode from instruction */
			$opcode = $instruction[$instrSize - 1];
			
			/* for readability */
			$P1 = $parameters[2];
			$P2 = $parameters[1];
			$P3 = $parameters[0];
			
			/* handle opcodes */
			/* add */
			if($opcode == 1){ 
				$this->program[$P3] = $this->program[$P1] + $this->program[$P2];
				$this->pointer += 4;
			}
			/* multiply */
			elseif($opcode == 2){
				$this->program[$P3] = $this->program[$P1] * $this->program[$P2];				
				$this->pointer += 4;
			}
			/* input */
			elseif($opcode == 3){

				if($this->inputBufferPointer == 0)
					$this->program[$P1] = $this->phaseSetting;
				elseif($this->inputBufferPointer-1 < count($this->inputBuffer))
					$this->program[$P1] = $this->inputBuffer[$this->inputBufferPointer-1];
				else
					return 0;

				$this->inputBufferPointer++;
				$this->pointer += 2;
			}
			/* output */
			elseif($opcode == 4){
				array_push($this->nextAmp->inputBuffer,$this->program[$P1]);
				$this->pointer += 2;
			}
			/* jump if true */
			elseif($opcode == 5){
				if($this->program[$P1] != 0)
					$this->pointer = $this->program[$P2];
				else
					$this->pointer += 3;
			}
			/* jump if false */
			elseif($opcode == 6){
				if($this->program[$P1] == 0)
					$this->pointer = $this->program[$P2];
				else
					$this->pointer += 3;
			} 
			/* less than */
			elseif($opcode == 7){
				if($this->program[$P1] < $this->program[$P2])
					$this->program[$P3] = 1;
				else
					$this->program[$P3] = 0;
				$this->pointer += 4;
			}
			/* equeals */
			elseif($opcode == 8){
				if($this->program[$P1] == $this->program[$P2])
					$this->program[$P3] = 1;
				else
					$this->program[$P3]= 0;
				$this->pointer += 4;
			}
			/* halt */
			elseif($opcode == 9){
				return 1;
				echo "done" . PHP_EOL;
				break;
			}
			/* opcode not found */
			else{
				echo "error 02 " . PHP_EOL . $opcode . PHP_EOL;
				break;
			}
		}
	}
}



echo "done";


$max= 0;
$result=0;
for($i=0;$i<3125;$i++){
	
	$digits = sprintf("%05d",base_convert($i,10,5));
	if(count(array_count_values(str_split($digits))) == 5){
		echo $digits . PHP_EOL;
		/*/*/

		$amp1 = new amp($input,$digits[0]+5);
		$amp2 = new amp($input,$digits[1]+5);
		$amp3 = new amp($input,$digits[2]+5);
		$amp4 = new amp($input,$digits[3]+5);
		$amp5 = new amp($input,$digits[4]+5);

		$amp1->nextAmp = $amp2;
		$amp2->nextAmp = $amp3;
		$amp3->nextAmp = $amp4;
		$amp4->nextAmp = $amp5;
		$amp5->nextAmp = $amp1;

		array_push($amp1->inputBuffer,0);

		while(true){
			echo "run..." . PHP_EOL;
			$amp1->amp();
			$amp2->amp();
			$amp3->amp();
			$amp4->amp();
			if($amp5->amp())
				break;
		}
		$r = $amp1->inputBuffer[count($amp1->inputBuffer)-1];
/**/

		if($max < $r){
			$max = $r;
			$result = $digits;
		}
	}
}
echo $max;
?>