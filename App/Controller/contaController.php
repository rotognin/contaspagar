<?php

namespace App\Controller;

use App\Model;

class contaController extends Controller
{
    public static function cadContaAction(array $post, array $get)
    {
        $conID = (isset($post['conID'])) ? $post['conID'] : 0;
        $_SESSION['conID'] = $conID;
        parent::viewAction('cadConta');
    }

    public static function preencherArray(array $post)
    {
        $conta = Model\Conta::getArray();

        foreach($conta as $campo => $valor)
        {
            $conta[$campo] = $post[$campo];
        }

        return $conta;
    }

    public static function atualizarContaAction(array $post, array $get)
    {
        $conta = self::preencherArray($post);

        if (!Model\Conta::validar($conta)){
            parent::ViewAction('cadConta');
            return;
        }

        if (Model\Conta::atualizar($conta)){
            parent::viewAction('contas');
        } else {
            $_SESSION['mensagem'] = 'Registro de Contas não atualizado.';
            parent::viewAction('cadConta');
        }
    }

    public static function gravarcontaAction(array $post, array $get)
    {
        $post['conID'] = 0;
        $conta = self::preencherArray($post);
        $conta['conIDUsu'] = $_SESSION['usuID'];

        if (!Model\Conta::validar($conta)) {
            parent::viewAction('cadConta');
            return;
        }

        if (Model\Conta::gravar($conta)) {
            parent::viewAction('contas');
        } else {
            $_SESSION['mensagem'] = 'Registro da Conta não gravado.';
            parent::viewAction('cadConta');
        }
    }
}