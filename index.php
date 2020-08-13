<?php

include_once("Classes/Hotel.php");
$hotel = new Hotel();

// print_r($hotel->semana);
// echo "<br>";
// print_r($hotel->precoDiaria);
// echo "<br>";
// print_r($hotel->acrescimo);
// echo "<br>";

// echo  "Custo: " .($hotel->precoDiaria[0] + $hotel->acrescimo[1]);

echo $hotel->tabelaDiaria();

