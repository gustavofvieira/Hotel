<?php

include_once("Classes/Hotel.php");
$hotel = new Hotel();

// print_r($hotel->semana);
// echo "<br>";
// print_r($hotel->precoDiaria);
// echo "<br>";
// print_r($hotel->acrescimo);
// echo "<br>";

// echo  "Custo: " .($hotel->precoDiaria[0] + $hotel->acrescimo[1]);

echo $hotel->tabelaDiaria();



// echo date("d/m/Y H:i:s",1563496718);// time stamp 01/01/1970
// echo "<br>";
// echo time();// traz os segundos de 1970 até hj
// echo "<br>";
// echo strtotime("2019-02-03");
// echo "<br>";
 $ts = strtotime("1996-11-25");
// $now = strtotime("now");
// $tomorrow = strtotime("+1 day");
// $sevenDays = strtotime("+1 week");
echo "<br>";
 echo date("l, d/m/Y",$ts);
// echo "<br>";
// echo date("l, d/m/Y",$now);
// echo "<br>";
// echo date("l, d/m/Y",$tomorrow);
// echo "<br>";
// echo date("l, d/m/Y",$sevenDays);

echo "<br>";
$dataInicio = strtotime("2020-08-01 16:39:00");
$dataFim = strtotime("2020-08-14");
echo date("l, d/m/Y",$dataInicio)." - ". date("l, d/m/Y",$dataFim);
$qtDias =date("d/m/Y",$dataFim) -  date("d/m/Y",$dataInicio);

echo "DtInicio: ".date("d/m/Y H:i:s",$dataInicio)."<br>";
$total = 0;
$horaCheckout = explode(" ",date("d/m/Y H:i:s",$dataInicio));
//echo $horaCheckout[1];
if($horaCheckout[1] >= "16:30:00"){
    echo "maior que 16:30";
    //$dataInicio += 86400;
    $qtDias+=1;
 }else{
    echo "menor que 16:30";
 }
 echo "<br>Qt dias: ".$qtDias."<br>";
 echo "DtInicio: ".date("d/m/Y H:i:s",$dataInicio)."<br>";
for($i=0 ; $i<$qtDias ; $i++){

    $datas = $dataInicio + ($i* 86400);
    $data = explode(",",date("l, d/m/Y",$datas) ) ;
    if($data[0] == $hotel->semana[0] || $data[0] == $hotel->semana[6]){
        echo $data[0];
        $total += $hotel->precoDiaria[1];
    }else{
        //echo $data[0];
        $total += $hotel->precoDiaria[0];
    }
}
echo $total;
//$data = explode(",",date("l, d/m/Y",$dataInicio));
//echo $data[0];















