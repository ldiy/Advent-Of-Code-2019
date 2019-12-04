<?php
$result = 0;
$low= 402328;
$max = 864247;

for($x =$low; $x<$max; $x++){
	$splited = str_split($x);
	$ok = false;
	$dec = true;
	for($i=0; $i<count($splited)-1; $i++){
			if($splited[$i+1] == $splited[$i])
				$ok = true;
			if($splited[$i+1] < $splited[$i])
				$dec = false;
		
	}
	if($dec && $ok)
		$result++;
	
}
echo $result;
?>