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
         
         $this->setData($result[0]);
        
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

             $this->setData($result[0]);
             
         }else{
             
             throw new Exception("Login e/ou senha incorretos!!!");
         }
    }
    
    public function setData($data){
        
        $this->setIdusuario($data['idusuario']);
        $this->setDeslogin($data['deslogin']);
        $this->setDessenha($data['dessenha']);
        $this->setDtcadastro(new DateTime($data['dtcadastro']));
        
    }
    
    public function insert(){
        
        $sql = new Sql();
        
        $result = $sql->select("CALL sp_usuario_insert(:LOGIN, :PASS)", array(
            ":LOGIN"=>$this->getDeslogin(),
            ":PASS"=>$this->getDessenha()
        ));
        
        if(count($result) > 0){
            
            $this->setData($result[0]);
        }
    }
    
    public function update($login, $pass){
        
        $this->setDeslogin($login);
        $this->setDessenha($pass);
        
        $sql = new Sql();
        
        $sql->query("UPDATE tb_usuario SET deslogin = :LOGIN, dessenha = :PASS WHERE idusuario = :ID", array(
            ":LOGIN"=>$this->getDeslogin(),
            ":PASS"=>$this->getDessenha(),
            "ID"=>$this->getIdusuario()
        ));
    }
    
    public function __construct($login = "", $pass = ""){
        $this->setDeslogin($login);
        $this->setDessenha($pass);
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