<?php
require_once("../../classes/Hospede.php");
require_once("../../classes/Hospedagem.php");
require_once("../../classes/quarto.php");

$hospede = new Hospede();
$hospedagem = new Hospedagem();
$quarto = new Quarto();
$hospede = new Hospede();
//Join com todas as tabelas trazendo todas as informações
//$hospede->searchByNome($nome);
$cpf = $_REQUEST["cpf"];
$lista = Hospedagem::getList();
if(empty($cpf)){
    echo json_encode($lista);
}

if(!empty($cpf)){
    $hospede->loadByCpf($cpf);

    $listaHosp = Hospedagem::historicoHospedagem($hospede->getIdhospede());
    $hospedagem->ultimoCheckoutEValorTotal($hospede->getIdhospede());
    echo "Ultima estadia: ".date('d/m/Y H:i:s', strtotime($hospedagem->getUltimaEstadia()))
    
        ."<br>Valor total de estadias: ".$hospedagem->getTotalValorHospedagens()."<br>";
    echo json_encode($listaHosp);

                     
}

