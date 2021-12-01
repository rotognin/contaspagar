<?php

/**
 * Listar os meses em aberto para alterar
 */

namespace App\View;

use App\Model as Model;

$mesesAbertos = Model\Mes::listar(false, MES_ABERTO);

if (!isset($_SESSION['mensagem']))
{
    $_SESSION['mensagem'] = '';
}

$mensagem = $_SESSION['mensagem'];
$_SESSION['mensagem'] = '';

?>

<!DOCTYPE html>
<html>
<?php include 'html' . DIRECTORY_SEPARATOR . 'head.php'; ?>
<body>
    <div class="w3-container w3-card-4">
        <h3>Lista de Meses em aberto</h3>
        <a class="w3-button w3-blue w3-margin-right" href="principal.php?action=menu">Início</a>
        <br><br>
    </div>
    <div class="w3-container w3-card-4 w3-padding">
        <?php include_once 'lib/mensagem.php'; ?>
        <h3>Meses em aberto:</h3>
        <table class='w3-table w3-striped w3-bordered'>
            <tr>
                <th>ID</th>
                <th>Mês</th>
                <th>Ano</th>
                <th>Observações</th>
                <th>Ação</th>
            </tr>

            <?php
                foreach ($mesesAbertos as $mesAberto)
                {
                    echo '<tr>';
                        echo '<td>' . $mesAberto['mesID'] . '</td>';
                        echo '<td>' . MES[$mesAberto['mesMes']] . '</td>';
                        echo '<td>' . $mesAberto['mesAno'] . '</td>';
                        echo '<td>' . $mesAberto['mesObservacoes'] . '</td>';
                        echo '<td>';
                            echo '<form method="post" action="principal.php?control=mes&action=selecionarMes">';
                                echo '<input type="hidden" name="mesID" value="' . $mesAberto['mesID'] . '">';
                                echo '<input type="submit" value="Selecionar" class="w3-button w3-small w3-blue">';
                            echo '</form>';
                        echo '</td>';
                    echo '</tr>';
                }
            ?>
        </table>
        <br>
    </div>
</body>
</html>