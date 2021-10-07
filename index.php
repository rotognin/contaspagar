<?php

session_start();

// Ao cair nessa página, se o usuário estiver logado, irá ser deslogado do sistema.
$_SESSION['usuID'] = 0;
$_SESSION['usuNome'] = '';
$_SESSION['dir'] = __DIR__ . DIRECTORY_SEPARATOR;

if (!isset($_SESSION['mensagem']))
{
    $_SESSION['mensagem'] = '';
}

$mensagem = $_SESSION['mensagem'];
$_SESSION['mensagem'] = '';

require_once ('lib' . DIRECTORY_SEPARATOR . 'definicoes.php');

?>

<!DOCTYPE html>
<html>
<?php include 'html' . DIRECTORY_SEPARATOR . 'head.php'; ?>
<body>
    <div>
        <header class="w3-container w3-blue w3-margin-top"><h3>Contas a Pagar - Pessoal</h3></header>
    </div>
    <br>
    <div class="w3-container w3-card-4">
        <div class="w3-container">
            <p>Entrar no sistema:
            <form method="post" class="w3-container" action="principal.php?action=login">
                <label for="login"><i class="fa fa-user"></i></label>
                <input type="text" id="login" name="login" autofocus>
                <br><br>
                <label for="senha"><i class="fa fa-key"></i></label>
                <input type="password" id="senha" name="senha">
                <br><br>
                <input type="submit" value="Entrar" class="w3-button w3-blue">
            </form>
            </p>
        </div>
        <?php include_once 'lib/mensagem.php'; ?>
    </div>
    </div>
</body>
</html>