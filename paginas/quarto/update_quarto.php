<?php
require_once("../classes/Hospede.php");
$cpf = $_REQUEST["cpf"];
$nome = $_REQUEST["nome"];
$telefone = $_REQUEST["telefone"];


if(!empty($cpf) || !empty($nome)){

    $hospede = new Hospede();
    //$hospede->loadByCpf($cpf);
    $hospede->loadByNome($nome);
 
    $hospede->update($nome,$cpf,$telefone);
    echo $hospede;
}

