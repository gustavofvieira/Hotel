<?php
require_once("sql.php");
class Hospedagem{
    private $idhospedagem;
    private $idhospede;
    private $idquarto;
    private $checkin;
    private $checkout;
    private $valor;
    private $finalizado;

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


    public function setData($data){
        $this->setIdHospedagem($data['id_hospedagem']);
        $this->setIdHospede($data['id_hospede']);
        $this->setIdQuarto($data['id_quarto']);
        $this->setCheckin($data['checkin']);
        $this->setCheckout($data['checkout']);
        $this->setValor($data['valor_hospedagem']);
        $this->setFInalizado($data['finalizado']);
    }



    public function insert($idhospede, $idquarto,$checkin,$finalizado){

        $sql = new Sql();
        $sql->query("INSERT INTO hospedagem (id_hospede,id_quarto,checkin,finalizado)
         values ("."'".$idhospede."'".","."'".$idquarto."'".","."'".$checkin."'".",0)");
         
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

}