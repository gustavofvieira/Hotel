<?php
require_once("../../classes/Hospede.php");
require_once("../../classes/Hospedagem.php");
require_once("../../classes/quarto.php");
//http://localhost/hotel/paginas/hospedagem/historico.php?cpf=099 quando quiser todos os hospedes tirar o parametro
$hospede = new Hospede();
$hospedagem = new Hospedagem();
$quarto = new Quarto();
$hospede = new Hospede();

$cpf = $_REQUEST["cpf"];
$lista = Hospedagem::getList();
if(empty($cpf)){
    echo json_encode($lista);
}

if(!empty($cpf)){
    $hospede->loadByCpf($cpf);

    $listaHosp = Hospedagem::historicoHospedagem($hospede->getIdhospede());
    $ultimoValor = Hospedagem::valorHospedagens($hospede->getIdhospede());
    $valorTotal = Hospedagem::valorUltimaHospedagem($hospede->getIdhospede());
    echo json_encode($ultimoValor);
    echo json_encode($valorTotal);
    echo json_encode($listaHosp);
 

                     
}

