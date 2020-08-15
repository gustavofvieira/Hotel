<?php
require_once("sql.php");
class Hospede{
    private $idhospede;
    private $nome;
    private $cpf;
    private $telefone;

    public function getIdhospede(){
        return $this->idhospede;
    }
    public function setIdhospede($value){
        $this->idhospede = $value; 
    }
    
    public function getNome(){
        return $this->nome;
    }
    public function setNome($value){
        $this->nome = $value; 
    }
    
    public function getCpf(){
        return $this->cpf;
    }
    public function setCpf($value){
        $this->cpf = $value; 
    }

    public function getTelefone(){
        return $this->telefone;
    }
    public function setTelefone($value){
        $this->telefone = $value; 
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

    public function loadByCpf($cpf){
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM hospede where cpf = :CPF", array(
            ":CPF"=>$cpf
        ));
        if(count($results) > 0){
             $this->setData($results[0]);
        }
    }
    
    public function loadByTelefone($telefone){
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM hospede where telefone= :TEL", array(
            ":TEL"=>$telefone
        ));
        if(count($results) > 0){
             $this->setData($results[0]);
        }
    }
    
    public function loadByNome($nome){
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM hospede where nome = :NOME", array(
            ":NOME"=>$nome
        ));
        if(count($results) > 0){
             $this->setData($results[0]);
        }
    }

    public static function getList(){
        $sql = new Sql();
        return $sql->select("SELECT * FROM hospede ORDER BY nome;");
    }

    public static function search($nome){
        $sql = new Sql();
        return $sql->select("SELECT * FROM hospede WHERE nome LIKE :SEARCH ORDER BY nome",array(
            ':SEARCH' => "%".$nome."%"
        ));
    }

    public function login($login,$password){
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM hospede where nome = :LOGIN AND cpf = :PASSWORD", array(
            ":LOGIN"=>$login,
            ":PASSWORD" => $password
        ));
        if(count($results) > 0){
           
            $this->setData($results[0]);
        
        }else{
            throw new Exception("Login e/ou senha inválidos");
        }
    }

    public function setData($data){
        $this->setIdhospede($data['id_hospede']);
        $this->setNome($data['nome']);
        $this->setCpf($data['cpf']);
        $this->setTelefone($data['telefone']);
       // $this->setDtNasc(new DateTime($data['dt_nasc']));
    }



    public function insert($nome,$cpf,$telefone){

        $sql = new Sql();
        $sql->query("INSERT INTO hospede (nome,cpf,telefone) values ("."'".$nome."'".","."'".$cpf."'".","."'".$telefone."'".")");
         
    }


    public function update($nome, $cpf,$telefone){
        if(!empty($nome)){
            $this->setNome($nome); 
        }
        if(!empty($cpf)){
            $this->setCpf($cpf); 
        }
        if(!empty($telefone)){
            $this->setTelefone($telefone); 
        }

        $sql = new Sql();
        $sql->query("UPDATE hospede SET nome = :NOME, cpf = :CPF, telefone = :TELEFONE WHERE id_hospede = :ID",array(
            ':NOME'=>$this->getNome(),
            ':CPF'=>$this->getCpf(),
            ':TELEFONE'=>$this->getTelefone(),
            ':ID'=>$this->getIdhospede()
        ));
    }

    public function delete(){
        $sql = new Sql();
        $sql->query("DELETE FROM hospede WHERE id_hospede = :ID", array(
            ':ID'=>$this->getIdhospede()
        ));
        $this->setIdhospede(0);
        $this->setNome("");
        $this->setCpf("");
        $this->setTelefone("");
       // $this->setDtNasc(new DateTime());
    }
    public function __construct($login = "", $password = ""){
        $this->setNome($login);
        $this->setCpf($password);
        
    }
    public function __toString(){
        return json_encode(array(
            "id_hospede"=>$this->getIdhospede(),
            "nome"=>$this->getNome(),
            "cpf"=>$this->getCpf(),
            "telefone"=>$this->getTelefone()
            //"dt_nasc"=>$this->getDtNasc()->format("d/m/Y H:m:s")
        ));
    }
    



}