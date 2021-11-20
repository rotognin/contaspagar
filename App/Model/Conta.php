<?php

namespace App\Model;

class Conta
{
    private static $tabela = 'contas_tb';
    
    private static $status = array(
        0 => 'Inativo',
        1 => 'Ativo'
    );

    public static function getStatus(int $conAtivo)
    {
        return self::$status[$conAtivo];
    }

    /**
     * Retorna um array com os campos da tabela
     */
    public static function getArray()
    {
        return array(
            'conID'            => 0,
            'conIDUsu'         => 0,
            'conNome'          => '',
            'conDiaVencto'     => 0,
            'conAtivo'         => 1,
            'conValorPrevisto' => 0.00,
            'conRecorrente'    => 0,
            'conIDFornecedor'  => 0,
            'conObservacao'    => ''
        );
    }

    public static function validar(array $conta)
    {
        if ($conta['conNome'] == '') {
            $_SESSION['mensagem'] = 'O nome da Conta deve ser preenchido.';
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
    
    public static function listar(bool $bTodos = true, int $conAtivo = 1)
    {
        $sql = 'SELECT c.conID, c.conIDUsu, c.conNome, c.conDiaVencto, ' . 
               'c.conAtivo, c.conValorPrevisto, c.conRecorrente, c.conIDFornecedor, ' .
               'f.forNome, c.conObservacao ' .
               'FROM contas_tb c ' . 
               'LEFT JOIN fornecedores_tb f ON c.conIDFornecedor = f.forID ' .
               'WHERE conIDUsu = :conIDUsu ';

        if (!$bTodos){
            $sql .= 'AND conAtivo = :conAtivo ';
        }

        $conn = Conexao::getConexao()->prepare($sql);
        $conn->bindValue('conIDUsu', $_SESSION['usuID'], \PDO::PARAM_INT);

        if (!$bTodos){
            $conn->bindValue('conAtivo', $conAtivo, \PDO::PARAM_INT);
        }

        $conn->execute();
        return $conn->fetchAll();
    }

    public static function carregar(int $conID)
    {
        $sql = 'SELECT * FROM contas_tb WHERE conID = :conID';
        $conn = Conexao::getConexao()->prepare($sql);
        $conn->bindValue('conID', $conID, \PDO::PARAM_INT);
        $conn->execute();
        $result = $conn->fetchAll();
        return $result[0];
    }
}