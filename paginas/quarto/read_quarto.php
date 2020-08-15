<?php
require_once("../classes/Quarto.php");


$lista = Quarto::getList();// chamando como metódo estático
echo json_encode($lista);