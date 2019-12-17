<?php
error_reporting(0);
$lines = file("input.txt", FILE_IGNORE_NEW_LINES);
Class Reaction
{
    public function __construct($reactionResult) 
    {
        $this->reactionResult = $reactionResult;
        $this->reactionResultQuantity = 0;
        $this->reactionProducts = array();
	}
}

$reactions = array();   // Holds all reaction objects

/* make object of each reaction */
foreach($lines as $line)
{
    $products = explode(" => ",$line);

    $neededProducts = explode(", ",$products[0]);
    $resultProductQuantity = explode(" ",$products[1]);

    $reaction = new Reaction($resultProductQuantity[1]);
    $reaction->reactionResultQuantity = $resultProductQuantity[0];

    foreach($neededProducts as $neededProduct)
    {
        $neededProductsQuantity = explode(" ",$neededProduct);
        $reaction->reactionProducts[$neededProductsQuantity[1]] = $neededProductsQuantity[0];
    }

    $reactions[$resultProductQuantity[1]] = $reaction;

}

function oreNeeded($name, $amount, &$reactions, &$buffer)
{
    if($name == "ORE")
        return($amount);

    while($amount > 0 && $buffer[$name] > 0){
        $amount -= 1;
        $buffer[$name] -= 1;
    }
    $times = ceil($amount / $reactions[$name]->reactionResultQuantity);
    if($times * $reactions[$name]->reactionResultQuantity - $amount > 0)
        $buffer[$name] += $times * $reactions[$name]->reactionResultQuantity - $amount;
    
    $result = 0;
    $productsNeeded =  $reactions[$name]->reactionProducts;

    foreach($productsNeeded as $pName => $value)
    {
        $result += oreNeeded($pName,$value * $times,$reactions, $buffer);
    }
    return $result;
}

$buffer = array();
echo oreNeeded("FUEL",1,$reactions,$buffer);

?>