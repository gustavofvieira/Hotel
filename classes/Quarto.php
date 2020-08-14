<?php
require_once("sql.php");
class Quarto{
    private $idQuarto;
    private $numero;
    private $descricao;
    private $ocupado;

    public function getIdQuarto(){
        return $this->idQuarto;
    }

    public function setIdQuarto($value){
        $this->idQuarto = $value; 
    }

    public function getNumero(){
        return $this->numero;
    }

    public function setNumero($value){
        $this->numero = $value; 
    }

    public function getDesc(){
        return $this->descricao;
    }

    public function setDesc($value){
        $this->descricao = $value; 
    }

    public function getOcupado(){
        return $this->ocupado;
    }

    public function setOcupado($value){
        $this->ocupado = $value; 
    }

    public function loadById($id){
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM hospede where id_hospede = :ID", array(
            ":ID"=>$id
        ));
        if(count($results) > 0){
             $this->setData($results[0]);
        }
    }

    public function loadByNum($numero){
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM quarto where numero = :NUM", array(
            ":NUM"=>$numero
        ));
        if(count($results) > 0){
             $this->setData($results[0]);
        }
    }

    public static function getList(){
        $sql = new Sql();
        return $sql->select("SELECT * FROM quarto ORDER BY nome;");
    }

    public static function search($descricao){
        $sql = new Sql();
        return $sql->select("SELECT * FROM quarto WHERE descricao LIKE :SEARCH ORDER BY nome",array(
            ':SEARCH' => "%".$descricao."%"
        ));
    }


    public function setData($data){
        $this->setIdQuarto($data['id_quarto']);
        $this->setNumero($data['numero']);
        $this->setDesc($data['descricao']);
        $this->setOcupado($data['ocupado']);
    }



    public function insert($numero,$descricao){

        $sql = new Sql();
        $sql->query("INSERT INTO quarto (numero,descricao) values ("."'".$numero."'".","."'".$descricao."'".")");
         
    }


    public function update($numero, $descricao,$ocupado){
        if(!empty($numero)){
            $this->setNumero($numero); 
        }
        if(!empty($descricao)){
            $this->setDesc($descricao); 
        }
        if(!empty($ocupado)){
            $this->setOcupado($ocupado); 
        }

        $sql = new Sql();
        $sql->query("UPDATE quarto SET numero = :NUM, descricao  = :DESCRICAO, ocupado = :OCUPADO WHERE id_hospede = :ID",array(
            ':NUM'=>$this->getNumero(),
            ':DESCRICAO'=>$this->getDesc(),
            ':OCUPADO'=>$this->getOcupado(),
            ':ID'=>$this->getIdQuarto()
        ));
    }

    public function delete(){
        $sql = new Sql();
        $sql->query("DELETE FROM quarto WHERE id_hospede = :ID", array(
            ':ID'=>$this->getIdQuarto()
        ));
        $this->setIdQuarto(0);
        $this->setNumero("");
        $this->setDesc("");
        $this->setOcupado(0);
       // $this->setDtNasc(new DateTime());
    }

    public function __toString(){
        return json_encode(array(
            "id_quarto"=>$this->getIdQuarto(),
            "numero"=>$this->getNumero(),
            "descricao"=>$this->getDesc(),
            "ocupado"=>$this->getOcupado()
            //"dt_nasc"=>$this->getDtNasc()->format("d/m/Y H:m:s")
        ));
    }
    

}