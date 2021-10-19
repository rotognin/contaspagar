<?php

namespace App\Model;

class FormaPagamento
{
    private static $tabela = 'formas_tb';
    
    private static $status = array(
        0 => 'Inativo',
        1 => 'Ativo'
    );

    public static function getStatus(int $fpgAtivo)
    {
        return self::$status[$fpgAtivo];
    }

    /**
     * Retorna um array com os campos da tabela
     */
    public static function getArray()
    {
        return array(
            'fpgID'    => 0,
            'fpgIDUsu' => 0,
            'fpgNome'  => '',
            'fpgAtivo' => 1
        );
    }

    public static function validar(array $forma)
    {
        if ($forma['fpgNome'] == '') {
            $_SESSION['mensagem'] = 'O nome (descrição) deve ser preenchido.';
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
    
    public static function listar(bool $bTodos = true, int $fpgAtivo = 1)
    {
        $sql = 'SELECT * FROM formas_tb WHERE fpgIDUsu = :fpgIDUsu ';

        if (!$bTodos){
            $sql .= 'AND fpgAtivo = :fpgAtivo ';
        }

        $conn = Conexao::getConexao()->prepare($sql);
        $conn->bindValue('fpgIDUsu', $_SESSION['usuID'], \PDO::PARAM_INT);

        if (!$bTodos){
            $conn->bindValue('fpgAtivo', $fpgAtivo, \PDO::PARAM_INT);
        }

        $conn->execute();
        return $conn->fetchAll();
    }

    public static function carregar(int $fpgID)
    {
        $sql = 'SELECT * FROM formas_tb WHERE fpgID = :fpgID';
        $conn = Conexao::getConexao()->prepare($sql);
        $conn->bindValue('fpgID', $fpgID, \PDO::PARAM_INT);
        $conn->execute();
        $result = $conn->fetchAll();
        return $result[0];
    }
}