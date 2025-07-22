<?php 

class Response extends Conexao {

    public $id;
    public $alternative_id;
    public $user_id;
    public $correct;
    public $conn;


    public function __construct() {
        $this->conn = $this->conexao();
    }

    /*
     * Calcula quantidades de respostas preenchidas
     * Date: 10/06/25
     * Author: Kayke Melo 
     * ação pra selecionar e contar as alternativas corretas atraves do id da resposta, executa e pega o valor total  
     */ 
    public function calculateResponseQuiz( $aResponse = []){

        if (!is_null($aResponse["resposta"]) && !is_null($this->conn)) {

            $placeholders = implode(',', array_fill(0, count($aResponse["resposta"]), '?'));
    
            $query = "SELECT count(*) as total FROM tb_alternative where correct = 1 and  ID IN ($placeholders)";
            
            $stmt = $this->conn->prepare($query);
            $stmt->execute(array_values($aResponse["resposta"]));
            
            $resultados = $stmt->fetchColumn();
           
            return $resultados;
            
            
        }
   }

   /*
    * salva as respostas das alternativas no banco de dados 
    * Date:10/06/25
    * author: Kayke Melo
    */
   public function save($aResponse = []){

        foreach ($aResponse['resposta'] as $response) {
                            
            $query = "INSERT INTO tb_response (alternative_id,user_id,execution_id) values ( ".$response.",".$_POST['id_User'].",".$_POST['execution_id'].")";
            $stmt = $this->conn->prepare($query);  
            $stmt->execute(); 
        }
        
        //return $response;
          
   }

   /*
   * pega a resposta marcada pelo usuario selecionando pelo id e coloca o resultado num array      
   * date 10/06/25 
   * author: Kayke Melo
   */
   public function getAlternativeSelected($alternative_id){
    
        $aSelected = [];

        if(!is_null($this->conn)){

            $query = "SELECT * FROM tb_response where alternative_id = ".$alternative_id;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            
            $aSelected = $stmt->fetchall(PDO::FETCH_ASSOC);
          

        return $aSelected;
       
        
          
   }

}
 
   
}

?>