<?php

namespace App\Model;

class Mes
{
    private static $tabela = 'meses_tb';
    
    private static $status = array(
        1 => 'Em aberto',
        2 => 'Fechado'
    );

    public static function getStatus(int $mesStatus)
    {
        return self::$status[$mesStatus];
    }

    /**
     * Retorna um array com os campos da tabela
     */
    public static function getArray()
    {
        return array(
            'mesID'          => 0,
            'mesIDUsu'       => 0,
            'mesAno'         => 0,
            'mesMes'         => 0,
            'mesStatus'      => 0,
            'mesData'        => '',
            'mesObservacoes' => '',
            'mesValor'       => 0.00
        );
    }

    public static function validar(array $mes)
    {
        if ($mes['mesMes'] == 0 || $mes['mesMes'] > 12) {
            $_SESSION['mensagem'] = 'Mês inválido';
            return false;
        }

        return true;
    }

    public static function gravar(array $dados)
    {
        return (self::validar($dados)) ? (int) Crud::inserir(self::$tabela, $dados) : 0;
    }

    public static function atualizar(array $dados)
    {
        return (self::validar($dados)) ? (int) Crud::atualizar(self::$tabela, $dados) : 0;
    }
    
    /**
     * Ao listar a tabela de meses, o padrão é listar todos.
     * Porém, se eu quiser listar apenas os meses em aberto ou fechados,
     * preciso passar "false" para todos e informar o status do mês que eu quero listar:
     * 1 - Meses em aberto, 2 - Meses Fechados
     */
    public static function listar(bool $bTodos = true, int $mesStatus = MES_ABERTO)
    {
        $sql = 'SELECT mesID, mesIDUsu, mesAno, mesMes, ' . 
               'mesStatus, mesData, mesObservacoes, mesValor ' .
               'FROM meses_tb ' .
               'WHERE mesIDUsu = :mesIDUsu ';

        if (!$bTodos){
            $sql .= 'AND mesStatus = :mesStatus ';
        }

        $conn = Conexao::getConexao()->prepare($sql);
        $conn->bindValue('mesIDUsu', $_SESSION['usuID'], \PDO::PARAM_INT);

        if (!$bTodos){
            $conn->bindValue('mesStatus', $mesStatus, \PDO::PARAM_INT);
        }

        $conn->execute();
        return $conn->fetchAll();
    }

    /**
     * Carregar o registro de um mês pelo ID do mesmo.
     */
    public static function carregar(int $mesID)
    {
        $sql = 'SELECT * FROM meses_tb WHERE mesID = :mesID';
        $conn = Conexao::getConexao()->prepare($sql);
        $conn->bindValue('mesID', $mesID, \PDO::PARAM_INT);
        $conn->execute();
        $result = $conn->fetchAll();
        return $result[0];
    }

    /**
     * Carregar o registro de um mês específico para o usuário logado
     */
    public static function carregarMes(int $mesMes, int $mesAno)
    {
        $sql = 'SELECT * FROM meses_tb WHERE mesIDUsu = :mesIDUsu AND mesMes = :mesMes AND mesAno = :mesAno';
        $conn = Conexao::getConexao()->prepare($sql);
        $conn->bindValue('mesIDUsu', $_SESSION['usuID'], \PDO::PARAM_INT);
        $conn->bindValue('mesMes', $mesMes, \PDO::PARAM_INT);
        $conn->bindValue('mesAno', $mesAno, \PDO::PARAM_INT);
        $conn->execute();
        $result = $conn->fetchAll();
        return $result[0];
    }
}