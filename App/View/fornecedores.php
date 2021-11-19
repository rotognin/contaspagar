<?php

/**
 * Listar os Fornecedores cadastrados
 */

namespace App\View;

use App\Model as Model;

$fornecedores = Model\Fornecedor::listar();

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
        <h3>Lista de Fornecedores</h3>
        <a class="w3-button w3-blue w3-margin-right" href="principal.php?action=menu">Início</a>
        <a class="w3-button w3-blue" href="principal.php?control=fornecedor&action=cadFornecedor">Novo</a>
        <br><br>
    </div>
    <div class="w3-container w3-card-4 w3-padding">
        <?php include_once 'lib/mensagem.php'; ?>
        <h3>Fornecedores:</h3>
        <table class='w3-table w3-striped w3-bordered'>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Tipo</th>
                <th>Situação</th>
                <th>Ação</th>
            </tr>

            <?php
                foreach ($fornecedores as $fornecedor)
                {
                    echo '<tr>';
                        echo '<td>' . $fornecedor['forID'] . '</td>';
                        echo '<td>' . $fornecedor['forNome'] . '</td>';
                        echo '<td>' . $fornecedor['forDescricao'] . '</td>';
                        echo '<td>' . $fornecedor['tipNome'] . '</td>';
                        echo '<td>' . Model\Fornecedor::getStatus($fornecedor['forAtivo']) . '</td>';
                        echo '<td>';
                            echo '<form method="post" action="principal.php?control=fornecedor&action=cadFornecedor">';
                                echo '<input type="hidden" name="forID" value="' . $fornecedor['forID'] . '">';
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