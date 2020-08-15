<?php
//http://localhost/hotel/paginas/hospedagem/checkout.php?cpf=099
require_once("../../classes/Hospede.php");
require_once("../../classes/Hospedagem.php");
require_once("../../classes/quarto.php");
include_once("../../classes/Hotel.php");

// QUando estiver fazendo o checkout, o metodo vai verificar quantos dias ele ficou e 
//contar quais dias foram fds e os de semana, multiplciar cada pelo respectivo valor
$cpf = $_REQUEST["cpf"];
$telefone = $_REQUEST["telefone"];
$nome = $_REQUEST["nome"];


$hotel = new Hotel();
$hospede = new Hospede();
$hospedagem = new Hospedagem();
$quarto = new Quarto();

if(!empty($cpf)){
    $hospede->loadByCpf($cpf);
    

    $hospedagem->checkout("",$cpf,"");
    
    $quarto->loadById($hospedagem->getIdQuarto());
    if(!empty($hospedagem->getIdHospedagem())){
        echo "HOSPEDE: ". $hospede->getNome() 
            ."<br>QUARTO: " .$quarto->getNumero()." Descrição: ".$quarto->getDesc()
            ."<br>Data CheckIn: " . date('d/m/Y H:i:s', strtotime($hospedagem->getCheckin()))
            ."<br>Data CheckOut: " .date('d/m/Y H:i:s', strtotime($hospedagem->getCheckout()))
            ."<br>Total de dias da estadia: " .$hospedagem->getTotalEstadia()
            ."<br>Dias Uteis:".$hospedagem->getQtDiasUteis()
            ."<br>Finais de semana:".$hospedagem->getQtDiasFDS()
            ."<br>Valor diária dias uteis:".$hotel->precoDiaria[0]
            ."<br>Valor diária dias fim de semana:".$hotel->precoDiaria[1]
            ."<br>Valor total:".$hospedagem->getValor()
            ."<br>Checkout Efetuado por CPF ";
            if($hospedagem->getGaragem() == 1){

                echo "<br>Garagem:".$hospedagem->getGaragem() 
                     ."<br>Acrescimo garagem dia util:".$hotel->acrescimo[0]
                     ."<br>Acrescimo garagem fim de semana:".$hotel->acrescimo[1];
            }
    }else{
       echo "Checkout não efetuado - Hospede não cadastrado";
    }
  
    
}


if(!empty($telefone)){
    $hospede->loadByTelefone($telefone);
    $hospedagem->checkout("","",$telefone);
    $quarto->loadById($hospedagem->getIdQuarto());
 
    if(!empty($hospedagem->getIdHospedagem())){
        echo "HOSPEDE: ". $hospede->getNome() 
            ."<br>QUARTO: " .$quarto->getNumero()." Descrição: ".$quarto->getDesc()
            ."<br>Data CheckIn: " . date('d/m/Y H:i:s', strtotime($hospedagem->getCheckin()))
            ."<br>Data CheckOut: " .date('d/m/Y H:i:s', strtotime($hospedagem->getCheckout()))
            ."<br>Total de dias da estadia: " .$hospedagem->getTotalEstadia()
            ."<br>Dias Uteis:".$hospedagem->getQtDiasUteis()
            ."<br>Finais de semana:".$hospedagem->getQtDiasFDS()
            ."<br>Valor diária dias uteis:".$hotel->precoDiaria[0]
            ."<br>Valor diária dias fim de semana:".$hotel->precoDiaria[1]
            ."<br>Valor total:".$hospedagem->getValor()
            ."<br>Checkout Efetuado por CPF ";
            if($hospedagem->getGaragem() == 1){

                echo "<br>Garagem:".$hospedagem->getGaragem() 
                     ."<br>Acrescimo garagem dia util:".$hotel->acrescimo[0]
                     ."<br>Acrescimo garagem fim de semana:".$hotel->acrescimo[1];
            }
    }else{
       echo "Checkout não efetuado - Hospede não cadastrado";
    }
}
if(!empty($nome)){
    $hospede->loadByNome($nome);
    $hospedagem->checkout($nome,"","");
    $quarto->loadById($hospedagem->getIdQuarto());
 
    if(!empty($hospedagem->getIdHospedagem())){
        echo "HOSPEDE: ". $hospede->getNome() 
            ."<br>QUARTO: " .$quarto->getNumero()." Descrição: ".$quarto->getDesc()

            ."<br>Data CheckIn: " . date('d/m/Y H:i:s', strtotime($hospedagem->getCheckin()))
            ."<br>Data CheckOut: " .date('d/m/Y H:i:s', strtotime($hospedagem->getCheckout()))
            ."<br>Total de dias da estadia: " .$hospedagem->getTotalEstadia()
            ."<br>Dias Uteis:".$hospedagem->getQtDiasUteis()
            ."<br>Finais de semana:".$hospedagem->getQtDiasFDS()
            ."<br>Valor diária dias uteis:".$hotel->precoDiaria[0]
            ."<br>Valor diária dias fim de semana:".$hotel->precoDiaria[1]
            ."<br>Valor total:".$hospedagem->getValor()
            ."<br>Checkout Efetuado por CPF ";
            if($hospedagem->getGaragem() == 1){

                echo "<br>Garagem:".$hospedagem->getGaragem() 
                     ."<br>Acrescimo garagem dia util:".$hotel->acrescimo[0]
                     ."<br>Acrescimo garagem fim de semana:".$hotel->acrescimo[1];
            }
    }else{
       echo "Checkout não efetuado - Hospede não cadastrado";
    }
}


