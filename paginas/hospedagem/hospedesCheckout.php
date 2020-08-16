<?php
require_once("../../classes/Hospede.php");
require_once("../../classes/Hospedagem.php");
require_once("../../classes/quarto.php");

$hospede = new Hospede();
$hospedagem = new Hospedagem();
$quarto = new Quarto();
$hospede = new Hospede();


$lista = Hospedagem::hospedesCheckout();

echo json_encode($lista);
