<?php 

class Usuario{ 

private $idusuario;
private $deslogin;
private $dessenha;
private $dtcadastro;

public function getIdusuario(){
    return $this->idusuario;
}

public function setIdusuario($idusuario){
    $this->idusuario = $idusuario;
}

public function getDeslogin(){
    return $this->deslogin;
}

public function setDeslogin($deslogin){
    $this->deslogin = $deslogin;
}

public function getDessenha(){
    return $this->dessenha;
}

public function setDessenha($dessenha){
    $this->dessenha = $dessenha;
}

public function getDtcadastro(){
    return $this->dtcadastro;
}

public function setDtcadastro($dtcadastro){
    $this->dtcadastro = $dtcadastro;
}

 public function loadbyId($id){
     
     $sql = new Sql();
     
     $result = $sql->select("SELECT * FROM tb_usuario WHERE idusuario = :ID" , array(":ID"=>$id));
     
     if(count($result) > 0){
         
         $row = $result[0];
         
         $this->setIdusuario($row['idusuario']);
         $this->setDeslogin($row['deslogin']);
         $this->setDessenha($row['dessenha']);
         $this->setDtcadastro(new DateTime($row['dtcadastro']));
         
     }
 }
    //Método busca todos os usuários
    public static function getList(){
        
        $sql = new Sql;
        
        return $sql->select("SELECT * FROM tb_usuario ORDER BY deslogin;");
    }
    
    //Busca pelo nome que o login tenha ou parte do nome
    public static function seach($login){
        $sql = new Sql();
        
        return $sql->select("SELECT * FROM tb_usuario WHERE deslogin LIKE :SEACH ORDER BY deslogin", array(
        ':SEACH'=>"%" .$login. "%"
        ));
    }
    
    //Faz uma validação dos parâmetros para poder retornar 
    public function login($login, $pass){
        
         $sql = new Sql();
     
     $result = $sql->select("SELECT * FROM tb_usuario WHERE deslogin = :LOGIN AND dessenha = :PASS" , array(
        ":LOGIN"=>$login,
        ":PASS"=>$pass 
     ));
     
         if(count($result) > 0){

             $row = $result[0];

             $this->setIdusuario($row['idusuario']);
             $this->setDeslogin($row['deslogin']);
             $this->setDessenha($row['dessenha']);
             $this->setDtcadastro(new DateTime($row['dtcadastro']));
         }else{
             
             throw new Exception("Login e/ou senha incorretos!!!");
         }
    }
     
     public function __toString(){
         
         return json_encode(array(
         "idusuario"=>$this->getIdusuario(),
         "deslogin"=>$this->getDeslogin(),
         "dessenha"=>$this->getDessenha(),
         "dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")     
         ));
     }
    
}

?>