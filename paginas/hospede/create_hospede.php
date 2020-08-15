<?php
//require_once("../config.php");
require_once("../classes/Hospede.php");
//http://localhost/hotel/paginas/create_hospede.php?nome=gustavo%20ferreira&cpf=12345678910&telefone=5571999293333
$nome = $_REQUEST["nome"];
$cpf = $_REQUEST["cpf"];
$telefone = $_REQUEST["telefone"];

if(!empty($nome) && !empty($cpf) && !empty($telefone)){

    $hospede = new Hospede();
    echo $hospede->insert($nome,$cpf,$telefone);
   
}else{

    echo "Parametros incompletos.";
}