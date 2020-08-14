<?php
require_once("../classes/Hospede.php");


$lista = Hospede::getList();// chamando como metódo estático
echo json_encode($lista);