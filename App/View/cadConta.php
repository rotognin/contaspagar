<?php

/**
 * Cadastro de Contas
 */

namespace App\View;

use App\Model as Model;

$conID = (isset($_SESSION['conID'])) ? $_SESSION['conID'] : 0;

$conta = Model\Conta::getArray();
$novo = true;

if ($conID > 0){
    $conta = Model\Conta::carregar($conID);

    if (!$conta){
        $_SESSION['mensagem'] = 'Não foi possível carregar os dados da Conta.';
    } else {
        $novo = false;
    }
}

$fornecedores = Model\Fornecedor::listar(false);

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
        <h3><?php echo verdade($novo, 'Nova ', 'Editar '); ?>Conta</h3>
        <a class="w3-button w3-blue" href="principal.php?action=menu">Início</a>
        <a class="w3-button w3-blue" href="principal.php?action=contas">Lista de Contas</a>
        <br><br>
    </div>
    <div class="w3-container w3-card-4 w3-margin">
        <p>
        <?php include_once 'lib/mensagem.php'; ?>
            <form method="post" 
                  class="w3-container" 
                  action="principal.php?control=conta&action=<?php echo verdade($novo, 'gravarConta', 'atualizarConta'); ?>">

                <!-- ID -->
                <?php 
                    echo Formulario::inputText(array(
                        'label'    => 'ID:',
                        'id'       => 'conID',
                        'value'    => $conta['conID'],
                        'readonly' => true,
                        'size'     => 10
                    ));
                ?>
                <br><br>
                <!-- Nome da Conta -->
                <?php 
                    echo Formulario::inputText(array(
                        'label'     => 'Nome:',
                        'id'        => 'conNome',
                        'value'     => $conta['conNome'],
                        'autofocus' => true,
                        'required'  => true
                    ));
                ?>
                <br><br>
                <!-- Dia de Vencimento -->
                <?php 
                    echo Formulario::inputText(array(
                        'label'     => 'Dia de Vencimento:',
                        'id'        => 'conDiaVencto',
                        'value'     => $conta['conDiaVencto'],
                        'autofocus' => false,
                        'required'  => true
                    ));
                ?>
                <br><br>
                <!-- Fornecedor -->
                <?php
                    echo Formulario::selectOption(array(
                        'label'      => 'Fornecedor:',
                        'name'       => 'conIDFornecedor',
                        'value'      => ($conta['conIDFornecedor'] > 0) ? $conta['conIDFornecedor'] : '',
                        'campoValue' => 'forID',
                        'campoLabel' => 'forNome',
                        'array'      => $fornecedores
                    ));
                ?>
                <br><br>
                <!-- Valor Previsto -->
                <?php 
                    echo Formulario::inputNumber(array(
                        'label'     => 'Valor Previsto:',
                        'id'        => 'conValorPrevisto',
                        'value'     => $conta['conValorPrevisto'],
                        'autofocus' => false,
                        'required'  => false,
                        'min'       => '0',
                        'step'      => '.01'
                    ));
                ?>
                <br><br>
                <!-- Observação -->
                <?php 
                    echo Formulario::inputText(array(
                        'label'     => 'Observação:',
                        'id'        => 'conObservacao',
                        'value'     => $conta['conObservacao'],
                        'autofocus' => false,
                        'required'  => false,
                        'size'      => '100'
                    ));
                ?>
                <br><br>
                <!-- Recorrente? -->
                <p>Conta recorrente?
                    <br>
                    <?php 
                        echo Formulario::inputRadio(array(
                            'label' => 'Sim',
                            'name'  => 'conRecorrente',
                            'value' => '1',
                            'campo' => $conta['conRecorrente']
                        ));
                    ?>
                    <br>
                    <?php 
                        echo Formulario::inputRadio(array(
                            'label' => 'Não',
                            'name'  => 'conRecorrente',
                            'value' => '0',
                            'campo' => $conta['conRecorrente']
                        ));
                    ?>
                </p>
                <!-- Situação -->
                <p>Situação:
                    <br>
                    <?php 
                        echo Formulario::inputRadio(array(
                            'label' => 'Ativo',
                            'name'  => 'conAtivo',
                            'value' => '1',
                            'campo' => $conta['conAtivo']
                        ));
                    ?>
                    <br>
                    <?php 
                        echo Formulario::inputRadio(array(
                            'label' => 'Inativo',
                            'name'  => 'conAtivo',
                            'value' => '0',
                            'campo' => $conta['conAtivo']
                        ));
                    ?>
                </p>
                <input type="hidden" name="conIDUsu" value="<?php echo $conta['conIDUsu']; ?>">
                <input type="submit" value="Gravar" class="w3-button w3-blue">
            </form>
        </p>
        <br>
    </div>
</body>
</html>