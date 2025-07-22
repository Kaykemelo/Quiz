<?php
session_start();

include "../conexao/Conexao.php";
include "../template/HeaderRanking.php";
include "../controller/Executions.php";

$oExecutions = new Executions($_SESSION['id_User']);
$aRanking = $oExecutions->getDataRanking();




?>
    <main class="box">

        <div class="List-container">
            <h1 class="title">Ranking</h1>
            <h2 class="subtitle">Confira o Ranking de Pontuações do Quiz</h2>
    
            <table class="ListRanking">
                <thead class="cabeçalhoRanking">
                    <tr>
                        <th>Nome</th>
                        <th>Data da Execução</th>
                        <th>Pontuação</th>
                    </tr>
                </thead>
                <tbody class="BodyRanking">
                    <?php 
                        foreach($aRanking as $ranking){
                            echo "<tr>";

                            echo "<td>".$ranking['Nome']."</td>";
                            echo "<td>".$ranking['Data_execucao']."</td>";
                            echo "<td>".$ranking['Pontuacao']."</td>";
                            echo "</tr>";
                        }
                   
                    ?>
                </tbody>
            </table>
        </div>
    </main>
<?php
    include "../template/Footer.php";
?>    

    
</body>
</html>
