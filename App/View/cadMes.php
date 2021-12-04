<?php

/**
 * Abertura e Fechamento de mês
 * Verificar se no GET está vindo o código do mês para fechamento, ou se está zerado para abertura
 */

namespace App\View;

use App\Model as Model;

$mesID = (isset($_SESSION['mesID'])) ? $_SESSION['mesID'] : 0;

$mes = Model\Mes::getArray();
$novo = true;

if ($mesID > 0){
    $mes = Model\Mes::carregar($mesID);

    if (!$mes){
        $_SESSION['mensagem'] = 'Não foi possível carregar os dados do Mês.';
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
        <h3><?php echo verdade($novo, 'Abertura ', 'Fechamento '); ?>do Mês</h3>
        <a class="w3-button w3-blue" href="principal.php?action=menu">Início</a>
        <br><br>
    </div>
    <div class="w3-container w3-card-4 w3-margin">
        <p>
        <?php include_once 'lib/mensagem.php'; ?>
            <form method="post" 
                  class="w3-container" 
                  action="principal.php?control=mes&action=<?php echo verdade($novo, 'abrirMes', 'fecharMes'); ?>">

                <!-- ID -->
                <?php 
                    echo Formulario::inputText(array(
                        'label'    => 'ID:',
                        'id'       => 'mesID',
                        'value'    => $mes['mesID'],
                        'readonly' => true,
                        'size'     => 10
                    ));
                ?>
                <br><br>
                <!-- Mês -->
                <?php 
                    echo Formulario::selectOption(array(
                        'label'      => 'Mês:',
                        'name'       => 'mesMes',
                        'value'      => ($mes['mesMes'] > 0) ? $mes['mesMes'] : '',
                        'campoValue' => $mes['mesMes'],
                        'campoLabel' => MES,
                        'array'      => MES
                    ));
                ?>
                <br><br>
                <!-- Ano -->
                <?php 
                    echo Formulario::inputNumber(array(
                        'label'     => 'Ano:',
                        'id'        => 'mesAno',
                        'value'     => $mes['mesAno'],
                        'required'  => true,
                        'min'       => '2019',
                        'step'      => '1'
                    ));
                ?>
                <br><br>
                <!-- Observações -->
                <?php 
                    echo Formulario::inputText(array(
                        'label'    => 'Observação:',
                        'id'       => 'mesObservacoes',
                        'value'    => $mes['mesObservacoes'],
                        'size'     => 50
                    ));
                ?>
                <br><br>
                <input type="hidden" name="forIDUsu" value="<?php echo $mes['mesIDUsu']; ?>">
                <input type="submit" value="Gravar" class="w3-button w3-blue">
            </form>
        </p>
        <br>
    </div>
</body>
</html>