<?php 

class Conexao {

    private string $servername = 'localhost';
    private string $database = 'quiz-kayke';
    private string $username = 'root';
    private string $password = '';
    public $conn;

    //cria uma função de conexão , com try catch pra tratar exceção de erro
    public function conexao() {
        
        try {
            $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->database", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }

        return $this->conn;
        
    }
     

}  
 
?>