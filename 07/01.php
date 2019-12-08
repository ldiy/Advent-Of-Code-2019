<?php
function amp($Uinput,$setting){
	$Uinput =(int)$Uinput;
	$setting = (int)$setting;
	$input = array(3,8,1001,8,10,8,105,1,0,0,21,42,63,76,101,114,195,276,357,438,99999,3,9,101,2,9,9,102,5,9,9,1001,9,3,9,1002,9,5,9,4,9,99,3,9,101,4,9,9,102,5,9,9,1001,9,5,9,102,2,9,9,4,9,99,3,9,1001,9,3,9,1002,9,5,9,4,9,99,3,9,1002,9,2,9,101,5,9,9,102,3,9,9,101,2,9,9,1002,9,3,9,4,9,99,3,9,101,3,9,9,102,2,9,9,4,9,99,3,9,1001,9,2,9,4,9,3,9,102,2,9,9,4,9,3,9,101,2,9,9,4,9,3,9,102,2,9,9,4,9,3,9,101,1,9,9,4,9,3,9,1001,9,2,9,4,9,3,9,1001,9,1,9,4,9,3,9,1001,9,2,9,4,9,3,9,1001,9,2,9,4,9,3,9,1001,9,1,9,4,9,99,3,9,102,2,9,9,4,9,3,9,1001,9,2,9,4,9,3,9,102,2,9,9,4,9,3,9,1002,9,2,9,4,9,3,9,1001,9,1,9,4,9,3,9,102,2,9,9,4,9,3,9,1002,9,2,9,4,9,3,9,102,2,9,9,4,9,3,9,1002,9,2,9,4,9,3,9,102,2,9,9,4,9,99,3,9,102,2,9,9,4,9,3,9,102,2,9,9,4,9,3,9,1002,9,2,9,4,9,3,9,1001,9,2,9,4,9,3,9,1002,9,2,9,4,9,3,9,1001,9,1,9,4,9,3,9,1002,9,2,9,4,9,3,9,1002,9,2,9,4,9,3,9,101,2,9,9,4,9,3,9,1001,9,2,9,4,9,99,3,9,1001,9,1,9,4,9,3,9,101,2,9,9,4,9,3,9,102,2,9,9,4,9,3,9,1001,9,2,9,4,9,3,9,1001,9,1,9,4,9,3,9,102,2,9,9,4,9,3,9,1001,9,2,9,4,9,3,9,1001,9,2,9,4,9,3,9,102,2,9,9,4,9,3,9,1001,9,2,9,4,9,99,3,9,102,2,9,9,4,9,3,9,101,1,9,9,4,9,3,9,1002,9,2,9,4,9,3,9,1002,9,2,9,4,9,3,9,1002,9,2,9,4,9,3,9,101,2,9,9,4,9,3,9,1001,9,2,9,4,9,3,9,101,2,9,9,4,9,3,9,1002,9,2,9,4,9,3,9,101,2,9,9,4,9,99);
	$len = count($input);
	$count= 0;
	for($pos =0; $pos < $len; $pos = $pos){
		$instruction = str_split($input[$pos]); // mode's and opcode
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
				$parameters[$i] = $input[$pos + 3 - $i];
			else if($parameters[$i] == 1)							// mode = 2
				$parameters[$i] = $pos + 3 - $i;
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
			$input[$P3] = $input[$P1] + $input[$P2];
			$pos += 4;
		}
		/* multiply */
		elseif($opcode == 2){
			//echo "p1 " .$input[$P1] . "|p2 " . $input[$P2];
			$input[$P3] = $input[$P1] * $input[$P2];
			
			$pos += 4;
		}
		/* input */
		elseif($opcode == 3){
			if($count == 0)
				$input[$P1] = $setting;
			if($count == 1)
				$input[$P1] = $Uinput;
			$count++;
			
			//echo "input given.." . PHP_EOL;
			$pos += 2;
		}
		/* output */
		elseif($opcode == 4){
			//echo("output: " . $input[$P1]) . PHP_EOL;
			return $input[$P1];
			$pos += 2;
		}
		/* jump if true */
		elseif($opcode == 5){
			if($input[$P1] != 0)
				$pos = $input[$P2];
			else
				$pos += 3;
		}
		/* jump if false */
		elseif($opcode == 6){
			if($input[$P1] == 0)
				$pos = $input[$P2];
			else
				$pos += 3;
		} 
		/* less than */
		elseif($opcode == 7){
			if($input[$P1] < $input[$P2])
				$input[$P3] = 1;
			else
				$input[$P3] = 0;
			$pos += 4;
		}
		/* equeals */
		elseif($opcode == 8){
			if($input[$P1] == $input[$P2])
				$input[$P3] = 1;
			else
				$input[$P3]= 0;
			$pos += 4;
		}
		/* halt */
		elseif($opcode == 9){
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

$max= 0;
$result=0;
for($i=0;$i<3125;$i++){
	
	$digits = sprintf("%05d",base_convert($i,10,5));
	if(count(array_count_values(str_split($digits))) == 5){
		echo $digits . PHP_EOL;
		//$digits = str_split(10432);
		$r= amp(amp(amp(amp(amp(0,$digits[0]),$digits[1]),$digits[2]),$digits[3]),$digits[4]);
		echo "out: " . $r . PHP_EOL;
		if($max < $r){
			$max = $r;
			$result = $digits;
			echo "now " . PHP_EOL;
		}
	}
}
echo $max;
//print_r($result);

?>