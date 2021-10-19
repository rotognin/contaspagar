<?php

namespace App\Controller;

use App\Model;

class tipoFornecedorController extends Controller
{
    public static function cadTipoFornecedorAction(array $post, array $get)
    {
        $tipID = (isset($post['tipID'])) ? $post['tipID'] : 0;
        $_SESSION['tipID'] = $tipID;
        parent::viewAction('cadTipoFornecedor');
    }

    public static function preencherArray(array $post)
    {
        $tipoFornecedor = Model\TipoFornecedor::getArray();

        foreach($tipoFornecedor as $campo => $valor)
        {
            $tipoFornecedor[$campo] = $post[$campo];
        }

        return $tipoFornecedor;
    }

    public static function atualizarTipoFornecedorAction(array $post, array $get)
    {
        $tipoFornecedor = self::preencherArray($post);

        if (!Model\TipoFornecedor::validar($tipoFornecedor)){
            parent::ViewAction('cadTipoFornecedor');
            return;
        }

        if (Model\TipoFornecedor::atualizar($tipoFornecedor)){
            parent::viewAction('tiposFornecedor');
        } else {
            $_SESSION['mensagem'] = 'Registro da Tipo de Fornecedores não atualizada.';
            parent::viewAction('cadTipoFornecedor');
        }
    }

    public static function gravarTipoFornecedorAction(array $post, array $get)
    {
        $post['tipID'] = 0;
        $tipoFornecedor = self::preencherArray($post);
        $tipoFornecedor['tipIDUsu'] = $_SESSION['usuID'];

        if (!Model\TipoFornecedor::validar($tipoFornecedor)) {
            parent::viewAction('cadTipoFornecedor');
            return;
        }

        if (Model\TipoFornecedor::gravar($tipoFornecedor)) {
            parent::viewAction('tiposFornecedor');
        } else {
            $_SESSION['mensagem'] = 'Registro do Tipo de Fornecedor não gravado.';
            parent::viewAction('cadTipoFornecedor');
        }
    }
}