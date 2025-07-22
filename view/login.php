<?php 

include "../conexao/Conexao.php";
include "../template/HeaderLogin.php";
include "../controller/User.php";



$oUser = new User();

// Autenticacao
if (isset($_POST['email']) && isset($_POST['senha'])) { 

    $bUser = $oUser->authentication($_POST['email'] , $_POST['senha']);

    if ($bUser) {

        header("Location: http://localhost/quiz/view/quiz.php");
        exit;

    }

    $msg = 'Usuario Não Encontrado'; 
} 

?>

    <main class="box">

        <div class="login-container">

            <h1 class="title">Login</h1>
            <h2 class="subtitle">Faça o seu Login no Quiz</h2> 
            <?php
                if (isset($msg)) {
                    echo "<h2 class='subtitle'>".$msg."</h2>";
                }
            ?>
            <?php
                if (isset($_GET['msgUser'])) {
                    echo "<h2 class='subtitle'>".$_GET['msgUser']."</h2>";
                }
            ?>

            <form action="../view/login.php" method="post">

                <div class="campo-email">
                    <label for="email">Email:</label>
                    <input type="text" id="email" name="email" required>
                </div>

                <div class="campo-senha">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" required>
                </div>
                <div class="botao">
                    <button type="submit" class="botao-login">Enviar</button>
                    <a href="../view/register.php" class="botao-cadastrar">Cadastre-se</a>
                </div>
            </form>
        </div>
    </main>
   
    <?php
    
    include "../template/Footer.php";
    ?>
   
</body>
</html>