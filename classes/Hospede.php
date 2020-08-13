<?php
require_once("sql.php");
class Hospede{
    private $idhospede;
    private $nome;
    private $cpf;
    private $dt_nasc;

    public function getIdhospede(){
        return $this->idhospede;
    }
    public function setIdusuario($value){
        $this->idusuario = $value; 
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

    public function getDtNasc(){
        return $this->dt_nasc;
    }
    public function setDtNasc($value){
        $this->dt_nasc = $value; 
    }

    public function loadById($id){
        $sql = new Sql();
        $results = $sql->select("SELECT *FROM hospede where id_hospede = :ID", array(
            ":ID"=>$id
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
        $this->setIdusuario($data['id_hospede']);
        $this->setNome($data['nome']);
        $this->setCpf($data['cpf']);
        $this->setDtNasc(new DateTime($data['dt_nasc']));
    }


    // public function insert(){
    //     $sql = new Sql();
    //     $results = $sql->select("CALL sp_usuarios_insert(:NOME,:CPF)",array(
    //         ':NOME'=>$this->getNome(),
    //         ':CPF'=>$this->getcpf()

    //     ));
        
    //     if(count($results) > 0){
    //         $this->setData($results[0]);
    //     }
    // }


    public function insert($nome,$cpf,$telefone){

        $sql = new Sql();
        $sql->query("INSERT INTO hospede (nome,cpf,telefone) values ("."'".$nome."'".","."'".$cpf."'".","."'".$telefone."'".")");
         
    }


    public function update($login, $password){
        $this->setNome($login);
        $this->setCpf($password);

        $sql = new Sql();
        $sql->query("UPDATE hospede SET nome = :NOME, cpf = :CPF WHERE id_hospede = :ID",array(
            ':NOME'=>$this->getNome(),
            ':CPF'=>$this->getCpf(),
            ':ID'=>$this->getIdhospede()
        ));
    }

    public function delete(){
        $sql = new Sql();
        $sql->query("DELETE FROM hospede WHERE id_hospede = :ID", array(
            ':ID'=>$this->getIdhospede()
        ));
        $this->setIdusuario(0);
        $this->setNome("");
        $this->setCpf("");
        $this->setDtNasc(new DateTime());
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
            "dt_nasc"=>$this->getDtNasc()->format("d/m/Y H:m:s")
        ));
    }
    
    

}