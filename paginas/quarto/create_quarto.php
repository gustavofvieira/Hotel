<?php
require_once("../../classes/Quarto.php");
//http://localhost/hotel/paginas/quarto/create_quarto.php?numero=1&descricao=de%20luxo
$numero = $_REQUEST["numero"];
$descricao = $_REQUEST["descricao"];

if(!empty($numero) && !empty($descricao)){

    $quarto = new Quarto();
    echo $quarto->insert($numero,$descricao);
    echo "Inserido.";


}else{

    echo "Parametros incompletos.";

}

$lista = Quarto::getList();// chamando como metódo estático
echo json_encode($lista);

