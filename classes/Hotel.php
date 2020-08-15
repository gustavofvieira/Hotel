<?php
/*
Regras de negócio
● Uma diária no hotel de segunda à sexta custa R$120,00;
● Uma diária no hotel em finais de semana custa R$150,00;
● Caso a pessoa precise de uma vaga na garagem do hotel há um acréscimo diário,
sendo R$15,00 de segunda à sexta e R$20,00 nos finais de semana;
● Caso o horário da saída seja após às 16:30h deve ser cobrada uma diária extra;*/

class Hotel{
    
    public $semana  = array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
    public $precoDiaria = array(120,150);
    public $acrescimo = array(15,20);

    public function tabelaDiaria(){

        $texto = "<br>Tabela da diária";
    
        for($i = 0 ; $i < 7 ; $i++){  
            if($i == 0 ){  
                   $texto .=  "<br>".$this->semana[$i] . "- Preço da diária: " .$this->precoDiaria[1];
            }    
            if($i != 0 && $i !=  6){  
                $texto .=  "<br>".$this->semana[$i] . "- Preço da diária: " .$this->precoDiaria[0];
            }  
            
            if($i == 6 ){  
                $texto .=  "<br>".$this->semana[$i] . "- Preço da diária: " .$this->precoDiaria[1];
            }
        } 
        return $texto;
    }

}