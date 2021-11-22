<?php

namespace App\Model;

class Usuario
{
    public static function getArray()
    {
        return array(
            'usuID'       => 0,
            'usuNome'     => '',
            'usuLogin'    => '',
            'usuSenha'    => '',
            'usuSituacao' => 0,
            'usuMes'      => 0,
            'usuAno'      => 0
        );
    }

    public static function carregar(int $usuID)
    {
        if (is_nan($usuID) || $usuID == 0){
            $_SESSION['mensagem'] = 'Carregamento incorreto: [Usuario - Carregar - ' . $usuID . ']';
            return false;
        }

        $sql = 'SELECT * FROM usuarios_tb WHERE usuID = :usuID';
        $conn = Conexao::getConexao()->prepare($sql);
        $conn->execute(array('usuID' => $usuID));
        $result = $conn->fetchAll();

        if (empty($result)){
            return false;
        }

        return $result[0];
    }

    public static function alterarMes(int $mes, int $ano)
    {
        $sql = 'UPDATE usuarios_tb SET usuMes = :usuMes, usuAno = :usuAno ' .
               'WHERE usuID = :usuID';
        $conn = Conexao::getConexao();
        $stmt = $conn->prepare($sql);

        $result = $stmt->execute(array(
            'usuMes' => $mes,
            'usuAno' => $ano,
            'usuID'  => $_SESSION['usuID']
        ));

        if ($result) {
            return (int) $stmt->rowCount();
        }

        return 0;
    }

    public static function verificarLogin(string $usuLogin, string $usuSenha){
        $sql = 'SELECT * FROM usuarios_tb WHERE usuLogin = :usuLogin';
        $conn = Conexao::getConexao()->prepare($sql);
        $conn->execute(array('usuLogin' => $usuLogin));
        $result = $conn->fetchAll();

        if (empty($result)){
            return false;
        }

        $usuSenhaSha1 = sha1($usuSenha);

        if ($usuSenhaSha1 != $result[0]['usuSenha']){
            return false;
        }

        return $result[0];
    }
}