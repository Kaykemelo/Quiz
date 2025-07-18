<?php 

session_start();

include "../conexao/conexao.php";
include "../template/headerList.php";
include "../controller/Executions.php";

$oListing = new Executions($_SESSION['id_User']);

$id_user = $_SESSION['id_User']; 
$aList = $oListing->list($id_user);

?>

    <main class="box">
        <div class="listing-container">
            <h1 class="title">Listagem Execuções</h1>
        
            <table class="listExecutions">
                <thead class="cabeçalhoList">
                    <tr>
                        <th>Usuario</th>
                        <th>Id Execução</th>
                        <th>Total de Acertos</th>
                        
                    </tr>
                </thead>
                <tbody class="bodyList">
                <?php
                     
                    foreach($aList as $list){
                        echo "<tr>";

                        echo "<td>".$list['Nome']."</td>";
                        echo "<td>".$list['id_execucao']."</td>";
                        echo "<td>".$list['total_acertos']."</td";
                        echo "</tr>";
                
                       
                    }
                ?>
                </tbody>
            </table>
        </div>
    </main>


<?php
include "../template/footer.php";
?>
    
</body>
</html>

