<?php 

class Alternative extends Conexao {

    public $id;
    public $question_id;
    public $text;
    public $conn;


    public function __construct() {
        $this->conn = $this->conexao();
    }
     
    /*
      * pega as alternativas atraves do id das perguntas e coloca o resultado num array 
      * 16/05/2025
      * author: Kayke Melo
    */
    public function getAnternativeByQuestionID($question_id){

        $aAlternatives = [];

        if (!is_null($this->conn)) {
            $query = "SELECT * FROM tb_alternative where question_id = ".$question_id;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
 
            $aAlternatives = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
         return  $aAlternatives; 
    }
}

?>