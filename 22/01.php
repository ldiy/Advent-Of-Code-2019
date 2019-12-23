<?php
$lines = file("input.txt", FILE_IGNORE_NEW_LINES);
$deck_size = 10007;
$deck = array();

function deal_with_increment($val) {
    global $deck, $deck_size;

    $temp = $deck;
    $index =  0;
    foreach($temp as $item){
        $deck[$index] = $item;
        $index += $val;
        while($index  >= $deck_size)
            $index -= $deck_size;
    }
}

function deal_into_new_stack() {
    global $deck;

    $deck = array_reverse($deck);
}

function cut($val){
    global $deck, $deck_size;

    if($val > 0){
        $p1 = array_slice($deck, 0, $val);
        $p2 = array_slice($deck, $val, $deck_size-$val);
        $deck = array_merge($p2,$p1);
    }
    if($val < 0){
        $p1 = array_slice($deck, $val, abs($val));
        $p2 = array_slice($deck, 0, $deck_size+$val);   // val < 0
        $deck = array_merge($p1,$p2);
    }
}

for($i = 0; $i < $deck_size; $i++)
    array_push($deck,$i);

foreach($lines as $line) {
    if(strpos($line, "deal into new stack") !== false){
        deal_into_new_stack();
    }
    if(strpos($line, "deal with increment") !== false){
        deal_with_increment((int)str_replace("deal with increment ","",$line));
    }
    if(strpos($line, "cut") !== false){
        cut((int)str_replace("cut ","",$line));
    }
}

//print_r($deck);
print_r(array_search(2019, $deck));
?>