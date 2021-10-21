<?php

/**
 * Cadastro de Tipos de Fornecedor
 */

namespace App\View;

use App\Model as Model;

$tipID = (isset($_SESSION['tipID'])) ? $_SESSION['tipID'] : 0;

$tipo = Model\TipoFornecedor::getArray();
$novo = true;

if ($tipID > 0){
    $tipo = Model\TipoFornecedor::carregar($tipID);

    if (!$tipo){
        $_SESSION['mensagem'] = 'Não foi possível carregar os dados do Tipo de Fornecedor.';
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
        <h3><?php echo verdade($novo, 'Nova ', 'Editar '); ?>Tipo de Fornecedor</h3>
        <a class="w3-button w3-blue" href="principal.php?action=menu">Início</a>
        <a class="w3-button w3-blue" href="principal.php?action=tiposFornecedor">Lista de Tipos de Fornecedores</a>
        <br><br>
    </div>
    <div class="w3-container w3-card-4 w3-margin">
        <p>
        <?php include_once 'lib/mensagem.php'; ?>
            <form method="post" 
                  class="w3-container" 
                  action="principal.php?control=tipoFornecedor&action=<?php echo verdade($novo, 'gravarTipoFornecedor', 'atualizarTipoFornecedor'); ?>">

                <!-- ID -->
                <?php 
                    echo Formulario::inputText(array(
                        'label'    => 'ID:',
                        'id'       => 'tipID',
                        'value'    => $tipo['tipID'],
                        'readonly' => true,
                        'size'     => 10
                    ));
                ?>
                <br><br>
                <!-- Nome do Tipo de Fornecedor -->
                <?php 
                    echo Formulario::inputText(array(
                        'label'     => 'Nome:',
                        'id'        => 'tipNome',
                        'value'     => $tipo['tipNome'],
                        'autofocus' => true,
                        'required'  => true
                    ));
                ?>
                <br><br>
                <!-- Descrição do Tipo de Fornecedor -->
                <?php 
                    echo Formulario::inputText(array(
                        'label'     => 'Descrição:',
                        'id'        => 'tipDescricao',
                        'value'     => $tipo['tipDescricao'],
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