<?php
ini_set('memory_limit', '1G');
error_reporting(0);

function calc_phase($input,$len, $amount){
    $result = array();
    for($i = $len -1; $i > $amount; $i--){
        $result[$i] = $result[$i+1] + $input[$i];
        $result[$i] = abs($result[$i] % 10);
        echo $i . PHP_EOL;
    }
    return $result;
}

function calc_n_phase($input,$n){
    $temp = $input;
    $out = $input;
    $len = count($temp);
    echo "phase 2: \n";
    for($n;$n>0;$n--){
        for($i=$len - 1;$i > 0; $i--){
            $out[$i-1] = ($temp[$i-1] + $out[$i]) % 10;
        }
        $temp = $out;
        echo $n . PHP_EOL;
    }
    return $temp;
}
$input = "59777373021222668798567802133413782890274127408951008331683345339720122013163879481781852674593848286028433137581106040070180511336025315315369547131580038526194150218831127263644386363628622199185841104247623145887820143701071873153011065972442452025467973447978624444986367369085768018787980626750934504101482547056919570684842729787289242525006400060674651940042434098846610282467529145541099887483212980780487291529289272553959088376601234595002785156490486989001949079476624795253075315137318482050376680864528864825100553140541159684922903401852101186028076448661695003394491692419964366860565639600430440581147085634507417621986668549233797848";
$temp = "";
for($i = 0; $i<10000; $i++)
    $temp .= $input;

$input = str_split($temp);
$len = count($input);

$temp = calc_phase($input,$len,5977737-1); // first 7 digits -1
$temp = array_reverse(str_split(implode($temp)));
$answer = calc_n_phase($temp,99);   // number of phases - 1

for($i = 0; $i<8; $i++)
    echo $answer[$i];

?>