<?php 

class Question extends Conexao {

    public $id;
    public $conn = null;
    public $question;
    public $dificullty;
    public $status;

    public function __construct() {
        $this->conn = $this->conexao();
    }

    /*
     * Lista as perguntas do banco de dados e pega o resultado num array 
     * 16/05/2025
     * author: Kayke Melo
     */
    public function index(){

        $aQuestions = [];

       if (!is_null($this->conn)) {
            $query = "SELECT * FROM tb_question";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            $aQuestions = $stmt->fetchAll(PDO::FETCH_ASSOC);
       }
            
        return  $aQuestions; 
     
    }
}

?>