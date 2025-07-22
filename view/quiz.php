<?php
date_default_timezone_set('America/Sao_Paulo');



include "../conexao/Conexao.php";
include "../controller/Verification.php";
include "../template/Header.php"; 
include "../controller/Executions.php";
include "../controller/Question.php";
include "../controller/Alternative.php";


$oVerification = new Verification();

if ($oVerification->checkSession() == false) {
    header("Location: http://localhost/quiz/view/login.php");
    
    
}

$oExecutions = new Executions($_SESSION['id_User']);
$_SESSION['execution_id'] = $oExecutions->insert($_SESSION['id_User']);


$oQuestions = new Question();
$oAlternatives = new Alternative();

$aQuestions = $oQuestions->index();


$msg = $_GET['msg'] ?? NULL; 



?>


    <main class="box">

            <div class="quiz-container">
               <h1 class="title">Quiz</h1>
               <?php
               if ($oVerification->checkSession() == true) {
                    echo "<h2 class='msgSession'>Olá ".$_SESSION['Nome']."</h2";
               }
               ?>
               <h2 class="subtitle">Responda nosso quiz e se junte ao nosso time!</h2>
           <?php 
                 if(!empty($_GET['msg'])){
                    echo "<h2 class='subtitle'>".$_GET['msg']."</h2>";  
                }
           ?>
                <form method="post"  action="result.php"> 
                    <!--cria um laço de repetição pra pegar as perguntas com o indice do array !--> 
                    <section class="questions-alternative">
                    <?php  foreach ($aQuestions as $question) { ?>
                    <?php    echo "<p class='question'>".$question['question']."</p>"; ?>
                    
                    <div class="options">
                        <!-- cria um metodo de pegar as alternativas atraves do id das perguntas !-->
                        <?php $aAlternatives = $oAlternatives->getAnternativeByQuestionID($question['id']); ?>
                        
                        <!-- cria um laço de repetição pra pegar as alternativas atraves do id da pergunta!-->
                        <?php  foreach ($aAlternatives as $alternative) {  ?>
                            <label><input type="radio" name="resposta[<?php echo $question['id']  ?>]" value="<?php echo $alternative['id']  ?>"> <?php echo $alternative['description'] ?></label>
                        <?php   } ?>
                        <hr>
                    </div>
                    <?php   } ?>

                    <div class="botao">
                        <button type="submit" class="botao-quiz">Enviar Quiz</button>  
                    </div>
                </form>
           </div>
    </main>

    
<?php 

    include "../template/Footer.php";

?>
    
</body>
</html>

