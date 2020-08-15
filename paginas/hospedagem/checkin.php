<?php
//http://localhost/hotel/paginas/hospedagem/checkin.php?cpf=123&garagem=0
require_once("../../classes/Hospede.php");
require_once("../../classes/Hospedagem.php");
require_once("../../classes/quarto.php");

$cpf = $_REQUEST["cpf"];
$telefone = $_REQUEST["telefone"];
$nome = $_REQUEST["nome"];
$garagem = $_REQUEST["garagem"];

$hospede = new Hospede();
$hospedagem = new Hospedagem();
$quarto = new Quarto();

if(!empty($cpf)){
    $hospede->loadByCpf($cpf);
                     
    $hospedagem->loadByQuartoLivre(0);

    $quarto->loadById($hospedagem->getIdQuarto());

    $hospedagem->checkin($hospede->getIdhospede(),$hospedagem->getIdQuarto(),$garagem);
    
 
    if(!empty($hospedagem->getIdHospedagem())){
        echo "HOSPEDE: ". $hospede->getNome() 
            ."<br>QUARTO: " .$quarto->getNumero()
            ."<br>Data Checkin: " .$hospedagem->getCheckin()
            ."<br>Checkin Efetuado por CPF ";
    }else{
        echo "Checkin não efetuado - Hospede não cadastrado";
    }
    
}


if(!empty($telefone)){
    $hospede->loadByTelefone($telefone);
    $hospedagem->loadByQuartoLivre(0);

    $quarto->loadById($hospedagem->getIdQuarto());

    $hospedagem->checkin($hospede->getIdhospede(),$hospedagem->getIdQuarto());
    
 
    if(!empty($hospedagem->getIdHospedagem())){
        echo "HOSPEDE: ". $hospede->getNome() 
            ."<br>QUARTO: " .$quarto->getNumero()
            ."<br>Data Checkin: " .$hospedagem->getCheckin()
            ."<br>Checkin Efetuado por Telefone ";
    }else{
        echo "Checkin não efetuado - Hospede não cadastrado";
    }

}
if(!empty($nome)){
    $hospede->loadByNome($nome);
    
    $hospedagem->loadByQuartoLivre(0);

    $quarto->loadById($hospedagem->getIdQuarto());

    $hospedagem->checkin($hospede->getIdhospede(),$hospedagem->getIdQuarto());
    
 
    if(!empty($hospedagem->getIdHospedagem())){
        echo "HOSPEDE: ". $hospede->getNome() 
            ."<br>QUARTO: " .$quarto->getNumero()
            ."<br>Data Checkin: " .$hospedagem->getCheckin()
            ."<br>Checkin Efetuado por Nome ";
    }else{
        echo "Checkin não efetuado - Hospede não cadastrado";
    }
    

}


