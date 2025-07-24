<?php

    include "../conexao/Conexao.php";
    include "../template/HeaderRegister.php";
    include "../controller/User.php";

    $oUser = new User();

    if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['senha'])) {
        
        $aReturn = $oUser->insertUser($_POST['nome'],$_POST['email'],$_POST['senha']);
        
        $msgUser = $aReturn ? 'Cadastro Concluido' : 'Erro ao cadastrar';

        if($aReturn){
           
    
            header("Location: http://localhost/quiz/view/login.php?msgUser=".$msgUser); 
            exit; 
        }
        
        header("Location: http://localhost/quiz/view/register.php?msgUser=".$msgUser);
       
    }
    
?>

    <main class="box"> 
        <div class="Register-container">
            <h1 class="title">Cadastro</h1>
            <h2 class="subtitle">Cadastre-se no nosso Quiz</h2>
            <?php
            if (!empty($_GET['msgUser'])) {
                echo '<h2 class="subtitle">"'.$_GET['msgUser'].'"</h2>';
            }
            ?>
            <form action="../view/register.php" method="post">

                <div class="campo-nome">
                    <label for="nome">Nome:</label>
                    <input type="text" id="name" name="nome" required> 
                </div>

                <div class="campo-email">
                    <label for="email">Email:</label>
                    <input type="text" id="email" name="email" required>
                </div>

                <div class="campo-senha">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" required>
                </div>
                
                <div class="botao">
                    <button type="submit" class="botao-cadastro">Enviar</button> 
                </div>
            </form>

        </div>

    </main>
   <?php
   include "../template/Footer.php";
   ?>
</body>
</html>