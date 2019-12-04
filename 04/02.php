<?php
$result = 0;
$min= 402328;
$max = 864247;

for($x =$min; $x<$max; $x++){
	$splited = str_split($x);
	$ok = false;
	$dec = true;
	$doubles = array_count_values($splited);
	for($i=0; $i<count($splited)-1; $i++){
			if($splited[$i+1] == $splited[$i] && $doubles[$splited[$i]] == 2)
				$ok = true;			
			if($splited[$i+1] < $splited[$i])
				$dec = false;		
	}
	if($dec && $ok)
		$result++;
	
}
echo $result;
?>