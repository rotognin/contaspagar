<?php

namespace App\Model;

class Fornecedor
{
    private static $tabela = 'fornecedores_tb';
    
    private static $status = array(
        0 => 'Inativo',
        1 => 'Ativo'
    );

    public static function getStatus(int $forAtivo)
    {
        return self::$status[$forAtivo];
    }

    /**
     * Retorna um array com os campos da tabela
     */
    public static function getArray()
    {
        return array(
            'forID'        => 0,
            'forIDUsu'     => 0,
            'forNome'      => '',
            'forDescricao' => '',
            'forIDTipo'    => 0,
            'forContato'   => '',
            'forAtivo'     => 1
        );
    }

    public static function validar(array $fornecedor)
    {
        if ($fornecedor['forNome'] == '') {
            $_SESSION['mensagem'] = 'O nome do Fornecedor deve ser preenchido.';
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
    
    public static function listar(bool $bTodos = true, int $forAtivo = 1)
    {
        $sql = 'SELECT f.forID, f.forIDUsu, f.forNome, f.forDescricao, ' . 
               'f.forIDTipo, t.tipNome, f.forContato, f.forAtivo ' .
               'FROM fornecedores_tb f ' . 
               'LEFT JOIN tipos_tb t ON f.forIDTipo = t.tipID ' .
               'WHERE forIDUsu = :forIDUsu ';

        if (!$bTodos){
            $sql .= 'AND forAtivo = :forAtivo ';
        }

        $conn = Conexao::getConexao()->prepare($sql);
        $conn->bindValue('forIDUsu', $_SESSION['usuID'], \PDO::PARAM_INT);

        if (!$bTodos){
            $conn->bindValue('forAtivo', $forAtivo, \PDO::PARAM_INT);
        }

        $conn->execute();
        return $conn->fetchAll();
    }

    public static function carregar(int $forID)
    {
        $sql = 'SELECT * FROM fornecedores_tb WHERE forID = :forID';
        $conn = Conexao::getConexao()->prepare($sql);
        $conn->bindValue('forID', $forID, \PDO::PARAM_INT);
        $conn->execute();
        $result = $conn->fetchAll();
        return $result[0];
    }
}