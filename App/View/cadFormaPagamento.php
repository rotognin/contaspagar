<?php

/**
 * Cadastro de Formas de Pagamento
 */

namespace App\View;

use App\Model as Model;

$fpgID = (isset($_SESSION['fpgID'])) ? $_SESSION['fpgID'] : 0;

$forma = Model\FormaPagamento::getArray();
$novo = true;

if ($fpgID > 0){
    $forma = Model\FormaPagamento::carregar($fpgID);

    if (!$forma){
        $_SESSION['mensagem'] = 'Não foi possível carregar os dados da Forma de Pagamento.';
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
        <h3><?php echo verdade($novo, 'Nova ', 'Editar '); ?>Forma de Pagamento</h3>
        <a class="w3-button w3-blue" href="principal.php?action=menu">Início</a>
        <a class="w3-button w3-blue" href="principal.php?action=formasPagamento">Lista de Formas de Pagamento</a>
        <br><br>
    </div>
    <div class="w3-container w3-card-4 w3-margin">
        <p>
        <?php include_once 'lib/mensagem.php'; ?>
            <form method="post" 
                  class="w3-container" 
                  action="principal.php?control=formaPagamento&action=<?php echo verdade($novo, 'gravarFormaPagamento', 'atualizarFormaPagamento'); ?>">

                <!-- ID -->
                <?php 
                    echo Formulario::inputText(array(
                        'label'    => 'ID:',
                        'id'       => 'fpgID',
                        'value'    => $forma['fpgID'],
                        'readonly' => true,
                        'size'     => 10
                    ));
                ?>
                <br><br>
                <!-- Nome da Forma de Pagamento -->
                <?php 
                    echo Formulario::inputText(array(
                        'label'     => 'Descrição:',
                        'id'        => 'fpgNome',
                        'value'     => $forma['fpgNome'],
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
                            'name'  => 'fpgAtivo',
                            'value' => '1',
                            'campo' => $forma['fpgAtivo']
                        ));
                    ?>
                    <br>
                    <?php 
                        echo Formulario::inputRadio(array(
                            'label' => 'Inativo',
                            'name' => 'fpgAtivo',
                            'value' => '0',
                            'campo' => $forma['fpgAtivo']
                        ));
                    ?>
                </p>
                <input type="hidden" name="fpgIDUsu" value="<?php echo $forma['fpgIDUsu']; ?>">
                <input type="submit" value="Gravar" class="w3-button w3-blue">
            </form>
        </p>
        <br>
    </div>
</body>
</html>