<?php
$start = array(1,0,0,3,1,1,2,3,1,3,4,3,1,5,0,3,2,1,13,19,1,9,19,23,2,13,23,27,2,27,13,31,2,31,10,35,1,6,35,39,1,5,39,43,1,10,43,47,1,5,47,51,1,13,51,55,2,55,9,59,1,6,59,63,1,13,63,67,1,6,67,71,1,71,10,75,2,13,75,79,1,5,79,83,2,83,6,87,1,6,87,91,1,91,13,95,1,95,13,99,2,99,13,103,1,103,5,107,2,107,10,111,1,5,111,115,1,2,115,119,1,119,6,0,99,2,0,14,0);
$result = 0;
$noun = 0;
$verb = 0; 
$input = $start;
while($result != 19690720){
	
	$len = count($input);
	for($opcode =0; $opcode < $len; $opcode += 4){
		if($input[$opcode] == 1)
			$input[$input[$opcode + 3]] = $input[$input[$opcode + 1]] + $input[$input[$opcode + 2]];

		elseif($input[$opcode] == 2)
			$input[$input[$opcode + 3]] = $input[$input[$opcode + 1]] * $input[$input[$opcode + 2]];

		elseif($input[$opcode] == 99){
			$result = $input[0];
			break;
		}
		else{
			echo "error" . PHP_EOL;
			break;
		}
	}
	if($result != 19690720){
		$input = $start;
		if($noun <99)
			$noun++;
		else{
			$noun = 0;
			$verb++;
		}
		$input[1] = $noun;
		$input[2] = $verb;
	}
}
echo "answer:  " . ((100 * $noun) + $verb) . PHP_EOL;
?>