<?php

function calculateOptimalCost($seatsNeeded) {
    $costSmall = 5000;
    $costMedium = 8000;
    $costLarge = 12000;

    $seatsSmall = 5;
    $seatsMedium = 10;
    $seatsLarge = 15;

    $bestCost = PHP_INT_MAX;
    $bestCombination = [];

    for ($large = 0; $large <= ceil($seatsNeeded / $seatsLarge); $large++) {
        for ($medium = 0; $medium <= ceil($seatsNeeded / $seatsMedium); $medium++) {
            $remainingSeats = $seatsNeeded - ($large * $seatsLarge + $medium * $seatsMedium);
            if ($remainingSeats < 0) continue;
            $small = ceil($remainingSeats / $seatsSmall);
            $totalCost = $large * $costLarge + $medium * $costMedium + $small * $costSmall;

            if ($totalCost < $bestCost) {
                $bestCost = $totalCost;
                $bestCombination = ['large' => $large, 'medium' => $medium, 'small' => $small];
            }
        }
    }

    if ($bestCombination['medium'] > 0) echo "M x {$bestCombination['medium']} \n";
    if ($bestCombination['large'] > 0) echo "L x {$bestCombination['large']} \n";
    if ($bestCombination['small'] > 0) echo "S x {$bestCombination['small']} \n";
    echo "Total = PHP {$bestCost}\n";
}

$handle = fopen("php://stdin", "r");
echo "Please input number (seat): ";
$seatsNeeded = trim(fgets($handle));

calculateOptimalCost((int)$seatsNeeded);
fclose($handle);

?>
