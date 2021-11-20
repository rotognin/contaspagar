<?php

/**
 * Listar as Contas cadastradas
 */

namespace App\View;

use App\Model as Model;

$contas = Model\Conta::listar();

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
        <h3>Lista de Contas</h3>
        <a class="w3-button w3-blue w3-margin-right" href="principal.php?action=menu">Início</a>
        <a class="w3-button w3-blue" href="principal.php?control=conta&action=cadConta">Nova</a>
        <br><br>
    </div>
    <div class="w3-container w3-card-4 w3-padding">
        <?php include_once 'lib/mensagem.php'; ?>
        <h3>Contas:</h3>
        <table class='w3-table w3-striped w3-bordered'>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Dia Vencto.</th>
                <th>Valor Prev.</th>
                <th>Fornecedor</th>
                <th>Situação</th>
                <th>Ação</th>
            </tr>

            <?php
                foreach ($contas as $conta)
                {
                    echo '<tr>';
                        echo '<td>' . $conta['conID'] . '</td>';
                        echo '<td>' . $conta['conNome'] . '</td>';
                        echo '<td>' . $conta['conDiaVencto'] . '</td>';
                        echo '<td>' . $conta['conValorPrevisto'] . '</td>';
                        echo '<td>' . $conta['forNome'] . '</td>';
                        echo '<td>' . Model\Conta::getStatus($conta['conAtivo']) . '</td>';
                        echo '<td>';
                            echo '<form method="post" action="principal.php?control=conta&action=cadConta">';
                                echo '<input type="hidden" name="conID" value="' . $conta['conID'] . '">';
                                echo '<input type="submit" value="Editar" class="w3-button w3-small w3-blue">';
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