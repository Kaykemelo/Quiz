<?php 

class Executions extends Conexao {

    public $id;
    public $id_user;
    public $created_at;

    public function __construct($id_user)
    {
        $this->conn = $this->conexao();
        $this->$id_user = $id_user; 
        
    }

    public function insert($id_user){

        if (!is_null($this->conn)) {
            
            $query = 'INSERT INTO tb_executions (user_id,created_at) VALUES ("'.$id_user.'", "'.date('Y-m-d H:i:s').'")';
           
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $this->conn->lastinsertid();
        }
    }

    public function list($id_user){

        $aList = [];

        if (!is_null($this->conn)) {
            
            $query = "SELECT COUNT(tb_response.alternative_id) AS total_acertos,
            tb_user.name AS Nome, tb_executions.id AS id_execucao
            FROM tb_user 
            INNER JOIN tb_executions ON tb_executions.user_id = tb_user.id
            INNER JOIN tb_response ON tb_response.execution_id = tb_executions.id
            INNER JOIN tb_alternative ON tb_response.alternative_id = tb_alternative.id
            WHERE tb_alternative.correct = 1 AND tb_user.id = ".$id_user."
            GROUP BY tb_user.name,tb_executions.id";
          
           
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            $aList = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        }
        return $aList;
    }
   
    public function getDataRanking(){

        $aRanking = [];

        if (!is_null($this->conn)) {
            
            $query = "SELECT tb_user.name AS Nome,tb_executions.created_at AS Data_execucao,
            COUNT(tb_response.alternative_id) AS Pontuacao 
            FROM tb_user 
            INNER JOIN tb_executions ON tb_executions.user_id = tb_user.id
            INNER JOIN tb_response ON tb_response.execution_id = tb_executions.id
            INNER JOIN tb_alternative ON tb_alternative.id = tb_response.alternative_id
            WHERE tb_alternative.correct = 1 
            GROUP BY tb_user.name , tb_executions.created_at
            ORDER BY Pontuacao DESC "; 
            
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            $aRanking = $stmt->fetchAll(PDO::FETCH_ASSOC);
          
          
        }
        return $aRanking;

    }

}
?>