<?php

namespace App\Model;

class Crud
{
    /**
     * Gravação dos dados na tabela passada.
     */
    public static function inserir(string $tabela, array $dados)
    {
        $sql = '';

        $arrayKeys = array_keys($dados);
        $columns   = implode(', ', $arrayKeys);

        $placeholdersArray = array_map(function ($key) { 
            return ":{$key}"; 
        }, $arrayKeys);

        $placeholders = implode(', ', $placeholdersArray);
        $keyAndValue  = array_combine($placeholdersArray, array_values($dados));

        $sql = "INSERT INTO {$tabela} ({$columns}) VALUES ({$placeholders})";

        try 
        {
            $conn = Conexao::getConexao();
            $stmt = $conn->prepare($sql);
            $result = $stmt->execute($keyAndValue);

            if ($result){
                return (int) $conn->lastInsertId();
            }
        } catch (\PDOException $exc)
        {
            die($exc->errorInfo[2]);
        }
    }

    /**
     * Atualização dos dados na tabela
     */
    public static function atualizar(string $tabela, array $dados)
    {

    }
}