<?php

namespace App\Controller;

use App\Model;

class fornecedorController extends Controller
{
    public static function cadFornecedorAction(array $post, array $get)
    {
        $forID = (isset($post['forID'])) ? $post['forID'] : 0;
        $_SESSION['forID'] = $forID;
        parent::viewAction('cadFornecedor');
    }

    public static function preencherArray(array $post)
    {
        $fornecedor = Model\Fornecedor::getArray();

        foreach($fornecedor as $campo => $valor)
        {
            $fornecedor[$campo] = $post[$campo];
        }

        return $fornecedor;
    }

    public static function atualizarFornecedorAction(array $post, array $get)
    {
        $fornecedor = self::preencherArray($post);

        if (!Model\Fornecedor::validar($fornecedor)){
            parent::ViewAction('cadFornecedor');
            return;
        }

        if (Model\Fornecedor::atualizar($fornecedor)){
            parent::viewAction('fornecedores');
        } else {
            $_SESSION['mensagem'] = 'Registro de Fornecedores não atualizada.';
            parent::viewAction('cadFornecedor');
        }
    }

    public static function gravarFornecedorAction(array $post, array $get)
    {
        $post['forID'] = 0;
        $fornecedor = self::preencherArray($post);
        $fornecedor['forIDUsu'] = $_SESSION['usuID'];

        if (!Model\Fornecedor::validar($fornecedor)) {
            parent::viewAction('cadFornecedor');
            return;
        }

        if (Model\Fornecedor::gravar($fornecedor)) {
            parent::viewAction('fornecedores');
        } else {
            $_SESSION['mensagem'] = 'Registro do Fornecedor não gravado.';
            parent::viewAction('cadFornecedor');
        }
    }
}