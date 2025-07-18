<?php 
session_start();

include "../template/header.php";
include "../conexao/conexao.php";
include "../controller/Response.php";
include "../controller/Executions.php";
include "../controller/Alternative.php";
include "../controller/Question.php";



$oResponse = new Response();

// Valida se respostas foram preenchidas , calcula e salva no banco e redireciona com msg pro usuario
if(count($_POST['resposta']) == 5) 
{
    $response  = $oResponse->calculateResponseQuiz($_POST);

    $_POST['id_User'] = $_SESSION['id_User'];
    $_POST['execution_id'] = $_SESSION['execution_id'];
    $oResponse->save($_POST);

    if (isset($_SESSION['execution_id'])) {
        unset($_SESSION['execution_id']);
    }
    
}
else{
    $msg = "Preencha Todos os campos do Formulario"; 
    
    header("location: http://localhost/quiz/view/quiz.php?msg=".$msg);
}

$oQuestions = new Question();
$aQuestions = $oQuestions->index();

$oAlternatives = new Alternative();

?>
    <main class="box"> 

        <div class="quiz-container">

        <h1 class="title">Resultado do Quiz</h1>
        <h2 class="subtitle">Confira o Resultado das perguntas e respostas do quiz</h2>
        <?php
        // verifica se a resposta for maior que 2 e exibe o resultado pro usuario 
           $status = ($response > 2) ? 'Parabens Pelo Desempenho' : 'Tente Novamente'; 
           
            echo "<div class='resultado'>
                     <span class='texto'>$status</span>
                     <span class='texto acertos'>Total de Acertos:</span>
                     <span class='numero'>$response</span>
            </div>";
        ?>

        <section class="questions-alternative">

          <?php   foreach ($aQuestions as $question) { ?>
          <?php echo "<p class='question'>".$question['question']."</p>";  ?>  

          <div class="options">  
            
            <?php  $aAlternatives = $oAlternatives->getAnternativeByQuestionID($question['id']); ?>
            <?php $color = '';
                  $bold  = '';
                  foreach ($aAlternatives as $alternative) { ?>
            <?php      

                    //pega a alternativa que o usuario responder atraves do id da alternativa 
                    $alternativeSelected = $oResponse->getAlternativeSelected($alternative['id']); 
                
                    //verifica se o usuario respondeu a alternativa , e se ela esta correta 
                    if (!empty($alternativeSelected)){

                        $bold = 'font-weight:bold;';
                        
                        $color = ($alternative["correct"] == 1) ? 'green' : 'red'; 
                       
                    }else {
                            $color = 'Black';
                    }
            ?>
                <span style='color: <?php echo $color?>; <?php echo $bold?>'><?php echo $alternative['description']?></span>
                        
           <?php $bold  = ''; } ?>
          <hr>
          </div>  
        
            <?php } ?>
        
         </section>

         <div class="botao">
         <a href="../view/quiz.php" class="botao-voltar">Novo Quiz</a>
         </div> 

        </div>
    </main>

<?php 
    include "../template/footer.php";

?>

</body>
</html>
