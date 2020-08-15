<?php
require_once("sql.php");
include_once("Hotel.php");
class Hospedagem{
    private $idhospedagem;
    private $idhospede;
    private $idquarto;
    private $checkin;
    private $checkout;
    private $garagem;
    private $valor;
    private $finalizado;
    private $qtQuartoLivre;
    private $totalEstadia;
    private $qtDiasUteis;
    private $qtDiasFds;
    


    public function getIdHospedagem(){
        return $this->idhospedagem;
    }
    public function setIdHospedagem($value){
        $this->idhospedagem = $value; 
    }
   
    public function getIdHospede(){
        return $this->idhospede;
    }
    public function setIdHospede($value){
        $this->idhospede = $value; 
    }
    
    public function getIdQuarto(){
        return $this->idquarto;
    }
    public function setIdQuarto($value){
        $this->idquarto = $value; 
    }

    public function getCheckin(){
        return $this->checkin;
    }
    public function setCheckin($value){
        $this->checkin = $value; 
    }

    public function getCheckout(){
        return $this->checkout;
    }
    public function setCheckout($value){
        $this->checkout = $value; 
    }

    public function getGaragem(){
        return $this->garagem;
    }
    public function setGaragem($value){
        $this->garagem = $value; 
    }
    public function getValor(){
        return $this->valor;
    }
    public function setValor($value){
        $this->valor = $value; 
    }

    public function getFinalizado(){
        return $this->finalizado;
    }
    public function setFInalizado($value){
        $this->finalizado = $value; 
    }

    public function getQtQuartoLivre(){
        return $this->qtQuartoLivre;
    }
    public function setQtQuartoLivre($value){
        $this->qtQuartoLivre = $value; 
    }
    public function getTotalEstadia(){
        return $this->totalEstadia;
    }
    public function setTotalEstadia($value){
        $this->totalEstadia = $value; 
    }
    public function getQtDiasUteis(){
        return $this->qtDiasUteis;
    }
    public function setQtDiasUteis($value){
        $this->qtDiasUteis = $value; 
    }
    public function getQtDiasFDS(){
        return $this->qtDiasFds;
    }
    public function setQtDiasFDS($value){
        $this->qtDiasFds = $value; 
    }

    public function loadById($id){
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM hospedagem where id_hospedagem = :ID", array(
            ":ID"=>$id
        ));
        if(count($results) > 0){
             $this->setData($results[0]);
        }
    }

 



    public static function getList(){
        $sql = new Sql();
        return $sql->select("SELECT * FROM hospedagem ORDER BY id_hospedagem ASC;");
    }

    //join com a table quarto
    public static function search($descricao){
        $sql = new Sql();
        return $sql->select("SELECT * FROM hospedagem WHERE descricao LIKE :SEARCH ORDER BY nome",array(
            ':SEARCH' => "%".$descricao."%"
        ));
    }




    public function loadByQuartoLivre($contaQuartos){
        $sql = new Sql();
        //Conta quantidade de quartos só pra saber quantos tem
        if($contaQuartos == 1){
            $results = $sql->select("SELECT * FROM quarto where ocupado = 0");
            
            if(count($results) > 0){
                 $this->setData($results[0]);
                 $this->setQtQuartoLivre(count($results));

                 //return count($results);
            }
        }else{
            //pega o primeiro quarto livre pra alocar pro hospede
            $results = $sql->select("SELECT * FROM quarto where ocupado = 0 LIMIT 1");
            if(count($results) > 0){
                 $this->setData($results[0]);
                 $this->setQtQuartoLivre(count($results));
                 return count($results);
            }
        }
 
    }

    public function confirmaHospedagem(){
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM hospedagem where id_hospede = :IDHOSPEDE and id_quarto = :IDQUARTO and finalizado = 0", array(
            ":IDHOSPEDE"=>$this->getIdHospede(),
            ":IDQUARTO"=>$this->getIdQuarto()
        ));
        if(count($results) > 0){
             $this->setData($results[0]);
        }
    }

    public function checkin($idhospede, $idquarto){
        $this->setIdHospede($idhospede);
        if($this->getQtQuartoLivre() > 0){
                $this->insert($idhospede, $idquarto);
                $this->confirmaHospedagem();
        }else{
            return "Não há vagas";
        }

    }
    public function insert($idhospede, $idquarto){

        $sql = new Sql();
        $sql->query("INSERT INTO hospedagem (id_hospede,id_quarto,checkin,finalizado)
         values ("."'".$idhospede."'".","."'".$idquarto."'".",NOW(),0)");

        $sql->query("UPDATE quarto SET ocupado = 1 where id_quarto  = :IDQUARTO",array(
        ':IDQUARTO'=>$this->getIdQuarto()
            )); 

            

    }



    public function update($idhospede, $idquarto,$checkin,$checkout,$valor,$finalizado){
        if(!empty($idhospede)){
            $this->setIdHospede($idhospede); 
        }
        if(!empty($idquarto)){
            $this->setIdQuarto($idquarto); 
        }
        if(!empty($checkin)){
            $this->setCheckin($checkin); 
        }
        if(!empty($checkout)){
            $this->setCheckout($checkout); 
        }
        if(!empty($valor)){
            $this->setValor($valor); 
        }
        if(!empty($finalizado)){
            $this->setFinalizado($finalizado); 
        }

        $sql = new Sql();
        $sql->query("UPDATE hospedagem SET id_hospede = :IDHOSPEDE, id_quarto  = :IDQUARTO, checkin = :CHECKIN, 
                        checkout = :CHECKOUT, valor_hospedagem = :VALOR, finalizado = :ISFIM WHERE id_hospedagem = :ID",array(
            ':IDHOSPEDE'=>$this->getIdHospede(),
            ':IDQUARTO'=>$this->getIdQuarto(),
            ':CHECKIN'=>$this->getCheckin(),
            ':CHECKOUT'=>$this->getCheckout(),
            ':VALOR'=>$this->getValor(),
            ':ISFIM'=>$this->getFinalizado(),
            ':ID'=>$this->getIdHospedagem()
        ));

    }


    public function __toString(){
        return json_encode(array(
            "id_hospedagem"=>$this->getIdHospedagem(),
            "id_hospede"=>$this->getIdHospede(),
            "id_quarto"=>$this->getIdQuarto(),
            "valor"=>$this->getValor(),
            "checkin"=>$this->getCheckin()->format("d/m/Y H:m:s"),
            "checkout"=>$this->getCheckout()->format("d/m/Y H:m:s"),
            "finalizado"=>$this->getFinalizado()
        ));
    }
    
    public function setData($data){
        $this->setIdHospedagem($data['id_hospedagem']);
        $this->setIdHospede($data['id_hospede']);
        $this->setIdQuarto($data['id_quarto']);
        $this->setCheckin($data['checkin']);
        $this->setCheckout($data['checkout']);
        $this->setValor($data['valor_hospedagem']);
        $this->setFInalizado($data['finalizado']);
        $this->setGaragem($data['garagem']);
    }


    ##################### CHECKOUT #################### toda verificação dentro do checkout pra chamar o update


   public function checkout($cpf){
                 $sql = new Sql();
                 $this->loadByHospedeOQuarto("",$cpf,"");
                 $this->confirmaHospedagem();
                $this->liberaQuarto();
                $this->setFinalizado(1);
                //$this->setCheckout("NOW()");
                $this->update($this->getIdHospede(),$this->getIdQuarto(),$this->getCheckin()
                ,$this->getCheckout(),$this->getValor(),$this->getFinalizado());
 
                $sql->query("UPDATE hospedagem SET checkout = NOW() WHERE id_hospedagem = :ID",array(
                       ':ID'=>$this->getIdHospedagem()
                        ));
                $this->confirmaCheckout();
                
                if($this->getGaragem() == 1){
                    $this->calculaEstadiaCA();
                }else{
                    $this->calculaEstadiaSA();
                }
                
                
               $this->update($this->getIdHospede(),$this->getIdQuarto(),$this->getCheckin()
                ,$this->getCheckout(),$this->getValor(),$this->getFinalizado());

    }


    // traz o quarto que o hospede está hospedado 
    public function loadByHospedeOQuarto($nome,$cpf,$telefone){
        $sql = new Sql();
        if(!empty($nome)){
            $results = $sql->select("SELECT * FROM hospedagem INNER JOIN hospede ON hospedagem.id_hospede = hospede.id_hospede and hospede.nome = :NOME and hospedagem.finalizado = 0", array(
                ":NOME"=>$nome
            ));
            if(count($results) > 0){
                 $this->setData($results[0]);
                
            }
        }
        if(!empty($cpf)){
            $results = $sql->select("SELECT * FROM hospedagem INNER JOIN hospede ON hospedagem.id_hospede = hospede.id_hospede and hospede.cpf = :CPF and hospedagem.finalizado = 0", array(
                ":CPF"=>$cpf
            ));

            if(count($results) > 0){
                 $this->setData($results[0]);
                
            }
        }
        if(!empty($telefone)){
            $results = $sql->select("SELECT * FROM hospedagem INNER JOIN hospede ON hospedagem.id_hospede = hospede.id_hospede and hospede.telefone = :TEL and hospedagem.finalizado = 0", array(
                ":TEL"=>$telefone
            ));
            if(count($results) > 0){
                 $this->setData($results[0]);
                
            }
        }
        
        
    }

    
    public function liberaQuarto(){
        $sql = new Sql();
        $sql->query("UPDATE quarto SET ocupado = 0 WHERE id_quarto = :IDQUARTO",array(
            ':IDQUARTO'=>$this->getIdQuarto()
        ));

    }

    public function calculaEstadiaSA(){
        $hotel = new Hotel();
      
        $qtDias = date("d/m/Y H:i:s",strtotime($this->getCheckout())) -  date("d/m/Y H:i:s",strtotime($this->getCheckin()));   
        $quantDiasUteis = 0;
        $quantDiasFDS = 0;
       $this->setTotalEstadia($qtDias);
        $total = 0;
        for($i=0 ; $i<$qtDias ; $i++){
            $datas = $this->getCheckin() + ($i* 86400);
            $data = explode(",",date("l, d/m/Y",$datas) ) ;

           
                
            if($data[0] == $hotel->semana[0] || $data[0] == $hotel->semana[6] && $this->getGaragem() == 0){
                $quantDiasFDS++;
                $this->setQtDiasFDS($quantDiasFDS);
             
                $total += $hotel->precoDiaria[1];
                
            }
            else{
                $quantDiasUteis++;
                $this->setQtDiasUteis($quantDiasUteis);
                $total += $hotel->precoDiaria[0];
            }
        }
        $this->setValor($total);
    }

    public function calculaEstadiaCA(){
        $hotel = new Hotel();
      
        $qtDias = date("d/m/Y H:i:s",strtotime($this->getCheckout())) -  date("d/m/Y H:i:s",strtotime($this->getCheckin()));   
        $quantDiasUteis = 0;
        $quantDiasFDS = 0;
       $this->setTotalEstadia($qtDias);
        $total = 0;
        for($i=0 ; $i<$qtDias ; $i++){
            $datas = $this->getCheckin() + ($i* 86400);
            $data = explode(",",date("l, d/m/Y",$datas) ) ;

           
            if($data[0] == $hotel->semana[0] || $data[0] == $hotel->semana[6] && $this->getGaragem() == 1){
                $quantDiasFDS++;
                $this->setQtDiasFDS($quantDiasFDS);
                $total += $hotel->acrescimo[1];
                $total += $hotel->precoDiaria[1];
                
            }
            else{
                $quantDiasUteis++;
                $this->setQtDiasUteis($quantDiasUteis);
                $total += $hotel->acrescimo[0];
                $total += $hotel->precoDiaria[0];
            }
        }
        $this->setValor($total);
    }





    public function confirmaCheckout(){
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM hospedagem where id_hospedagem = :IDHOSPEDAGEM and
        id_hospede = :IDHOSPEDE and id_quarto = :IDQUARTO and finalizado = 1" , array(
            ":IDHOSPEDAGEM"=>$this->getIdHospedagem(),
            ":IDHOSPEDE"=>$this->getIdHospede(),
            ":IDQUARTO"=>$this->getIdQuarto()
        ));
        if(count($results) > 0){
             $this->setData($results[0]);
        }
    }
   
}