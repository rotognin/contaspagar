<?php

/**
 * Cadastro de Fornecedores
 */

namespace App\View;

use App\Model as Model;

$forID = (isset($_SESSION['forID'])) ? $_SESSION['forID'] : 0;

$fornecedor = Model\Fornecedor::getArray();
$novo = true;

if ($forID > 0){
    $fornecedor = Model\Fornecedor::carregar($forID);

    if (!$fornecedor){
        $_SESSION['mensagem'] = 'Não foi possível carregar os dados do Fornecedor.';
    } else {
        $novo = false;
    }
}

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
    <div class="w3-container w3-card-4 w3-margin">
        <h3><?php echo verdade($novo, 'Novo ', 'Editar '); ?>Fornecedor</h3>
        <a class="w3-button w3-blue" href="principal.php?action=menu">Início</a>
        <a class="w3-button w3-blue" href="principal.php?action=fornecedores">Lista de Fornecedores</a>
        <br><br>
    </div>
    <div class="w3-container w3-card-4 w3-margin">
        <p>
        <?php include_once 'lib/mensagem.php'; ?>
            <form method="post" 
                  class="w3-container" 
                  action="principal.php?control=fornecedor&action=<?php echo verdade($novo, 'gravarFornecedor', 'atualizarFornecedor'); ?>">

                <!-- ID -->
                <?php 
                    echo Formulario::inputText(array(
                        'label'    => 'ID:',
                        'id'       => 'forID',
                        'value'    => $fornecedor['forID'],
                        'readonly' => true,
                        'size'     => 10
                    ));
                ?>
                <br><br>
                <!-- Nome do Fornecedor -->
                <?php 
                    echo Formulario::inputText(array(
                        'label'     => 'Nome:',
                        'id'        => 'forNome',
                        'value'     => $fornecedor['forNome'],
                        'autofocus' => true,
                        'required'  => true
                    ));
                ?>
                <br><br>
                <!-- Descrição do Fornecedor -->
                <?php 
                    echo Formulario::inputText(array(
                        'label'     => 'Descrição:',
                        'id'        => 'forDescricao',
                        'value'     => $fornecedor['forDescricao'],
                        'autofocus' => true,
                        'required'  => true
                    ));
                ?>
                <br><br>


                
                <!-- Situação -->
                <p>Situação:
                    <br>
                    <?php 
                        echo Formulario::inputRadio(array(
                            'label' => 'Ativo',
                            'name'  => 'tipAtivo',
                            'value' => '1',
                            'campo' => $tipo['tipAtivo']
                        ));
                    ?>
                    <br>
                    <?php 
                        echo Formulario::inputRadio(array(
                            'label' => 'Inativo',
                            'name'  => 'tipAtivo',
                            'value' => '0',
                            'campo' => $tipo['tipAtivo']
                        ));
                    ?>
                </p>
                <input type="hidden" name="tipIDUsu" value="<?php echo $tipo['tipIDUsu']; ?>">
                <input type="submit" value="Gravar" class="w3-button w3-blue">
            </form>
        </p>
        <br>
    </div>
</body>
</html>