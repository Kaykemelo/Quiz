<?php

class User extends Conexao {

    public $id;
    public $name;
    public $conn;

    public function __construct() {
        $this->conn = $this->conexao();
    }

    public function authentication($email, $senha){
       
        $iCount = 0; 

        if (!is_null($this->conn)) {
             
            $query = 'SELECT * FROM tb_user where email = "'.$email.'" and senha = "'.$senha.'"';

            $stmt = $this->conn->prepare($query);
            $stmt->execute(); 
            $iCount  = $stmt->rowCount();
           
            if ($iCount > 0) {
                $aUser = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                $this->createSession($aUser[0]["name"], $aUser[0]["id"]);
                
               
                return true;
            }
        }
        
        return false; 
    }

    public function createSession($name_user, $id_user){
        // Cria variaveis de sesssao

        session_start();

        $_SESSION['Nome'] = $name_user;
        $_SESSION['id_User'] = $id_user;  
         
        
    }

    public function insertUser($name,$email,$senha){

        $aReturn = [];
        
        if (!is_null($this->conn)) {
            
            $query = 'INSERT INTO tb_user (name,email,senha,status) VALUES ("'.$name.'", "'.$email.'" , "'.$senha.'", "1")';
            
            $stmt = $this->conn->prepare($query);
            
            $status = ($stmt->execute()) ? true : false;
            
            $aReturn['status'] = $status;
            
        }
        
        return  $aReturn;

       
    }


    public function show(){
        //busca um usuario pelo id;
    }

    public function store(){
        //inserir um novo usuario;
    }

    public function update(){
        //altera um usuario;
    }

    public function delete(){
        //deleta um usuario;  
    }
}
?>