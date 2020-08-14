<?php
require_once("../classes/Hospede.php");
$cpf = $_REQUEST["cpf"];

if(!empty($cpf) || !empty($nome)){

    $hospede = new Hospede();
    $hospede->loadByCpf($cpf);
    $hospede->delete();
    echo $hospede;
}

