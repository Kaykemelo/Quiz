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



    /*
     * Busca Pergunta especifica atraves do ID
     * 16/05/2025
     * author: Kayke Melo
     */
    public function show($id){
        // retorna a pergunta especifica; 
    }

    public function store() {
        //retorna uma inserção de uma nova pergunta ;  
    }

    public function update(){
        //retorna uma alteração de uma pergunta ;
    }

    public function delete(){
        //retorna uma exclusão de uma pergunta ; 
    }
}














?>