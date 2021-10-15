<?php

/**
 * Listar todas as formas de pagamento cadastradas, com a opção de alterar o Status delas
 */

namespace App\View;

use App\Model as Model;

$formaPagamento = Model\FormaPagamento::listar();

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
        <h3>Lista de Formas de Pagamento</h3>
        <a class="w3-button w3-blue w3-margin-right" href="principal.php?action=menu">Início</a>
        <a class="w3-button w3-blue" href="principal.php?control=formaPagamento&action=cadFormaPagamento">Nova</a>
        <br><br>
    </div>
    <div class="w3-container w3-card-4 w3-padding">
        <?php include_once 'lib/mensagem.php'; ?>
        <h3>Formas de Pagamento:</h3>
        <table class='w3-table w3-striped w3-bordered'>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Situação</th>
                <th>Ação</th>
            </tr>

            <?php
                foreach ($formaPagamento as $forma)
                {
                    echo '<tr>';
                        echo '<td>' . $forma['fpgID'] . '</td>';
                        echo '<td>' . $forma['fpgNome'] . '</td>';
                        echo '<td>' . Model\FormaPagamento::getStatus($forma['fpgAtivo']) . '</td>';
                        echo '<td>';
                            echo '<form method="post" action="principal.php?control=formaPagamento&action=cadFormaPagamento">';
                                echo '<input type="hidden" name="fpgID" value="' . $forma['fpgID'] . '">';
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