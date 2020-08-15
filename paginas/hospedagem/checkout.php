<?php
require_once("../../classes/Hospede.php");
require_once("../../classes/Hospedagem.php");
require_once("../../classes/quarto.php");

// QUando estiver fazendo o checkout, o metodo vai verificar quantos dias ele ficou e 
//contar quais dias foram fds e os de semana, multiplciar cada pelo respectivo valor
$cpf = $_REQUEST["cpf"];
$telefone = $_REQUEST["telefone"];
$nome = $_REQUEST["nome"];

$hospede = new Hospede();
$hospedagem = new Hospedagem();
$quarto = new Quarto();

if(!empty($cpf)){
    $hospede->loadByCpf($cpf);
    

    $hospedagem->checkout($cpf);
    
 
    if(!empty($hospedagem->getIdHospedagem())){
        echo "HOSPEDE: ". $hospede->getNome() 
            ."<br>QUARTO: " .$quarto->getNumero()
            ."<br>Data CheckIn: " . date('d/m/Y H:i:s', strtotime($hospedagem->getCheckin()))
            ."<br>Data CheckOut: " .$hospedagem->getCheckout()
            ."<br>Id quarto: " .$hospedagem->getIdQuarto();
            //."<br>Total da estadia: " .$hospedagem->getTotalEstadia()
           // ."<br>Valor total:".$hospedagem->getValor()
          //  ."<br>Checkout Efetuado por CPF ";
    }else{
       echo "Checkout não efetuado - Hospede não cadastrado";
    }
  
    
}

/*
if(!empty($telefone)){
    $hospede->loadByTelefone($telefone);
    $hospedagem->loadByQuartoLivre(0);

    $quarto->loadById($hospedagem->getIdQuarto());

    $hospedagem->checkout($hospede->getIdhospede(),$hospedagem->getIdQuarto());
    
 
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

    $hospedagem->checkout($hospede->getIdhospede(),$hospedagem->getIdQuarto());
    
 
    if(!empty($hospedagem->getIdHospedagem())){
        echo "HOSPEDE: ". $hospede->getNome() 
            ."<br>QUARTO: " .$quarto->getNumero()
            ."<br>Data Checkin: " .$hospedagem->getCheckin()
            ."<br>Checkout Efetuado por Nome ";
    }else{
        echo "Checkout não efetuado - Hospede não cadastrado";
    }
    
*/


