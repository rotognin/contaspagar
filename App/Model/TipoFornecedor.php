<?php

namespace App\Model;

class TipoFornecedor
{
    private static $tabela = 'tipos_tb';
    
    private static $status = array(
        0 => 'Inativo',
        1 => 'Ativo'
    );

    public static function getStatus(int $tipAtivo)
    {
        return self::$status[$tipAtivo];
    }

    /**
     * Retorna um array com os campos da tabela
     */
    public static function getArray()
    {
        return array(
            'tipID'    => 0,
            'tipIDUsu' => 0,
            'tipNome'  => '',
            'tipDescricao' => '',
            'tipAtivo' => 1
        );
    }

    public static function validar(array $forma)
    {
        if ($forma['tipNome'] == '') {
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
    
    public static function listar(bool $bTodos = true, int $tipAtivo = 1)
    {
        $sql = 'SELECT * FROM tipos_tb WHERE tipIDUsu = :tipIDUsu ';

        if (!$bTodos){
            $sql .= 'AND tipAtivo = :tipAtivo ';
        }

        $conn = Conexao::getConexao()->prepare($sql);
        $conn->bindValue('tipIDUsu', $_SESSION['usuID'], \PDO::PARAM_INT);

        if (!$bTodos){
            $conn->bindValue('tipAtivo', $tipAtivo, \PDO::PARAM_INT);
        }

        $conn->execute();
        return $conn->fetchAll();
    }

    public static function carregar(int $tipID)
    {
        $sql = 'SELECT * FROM tipos_tb WHERE tipID = :tipID';
        $conn = Conexao::getConexao()->prepare($sql);
        $conn->bindValue('tipID', $tipID, \PDO::PARAM_INT);
        $conn->execute();
        $result = $conn->fetchAll();
        return $result[0];
    }
}