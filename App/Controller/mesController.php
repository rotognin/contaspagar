<?php

namespace App\Controller;

use App\Model;

class mesController extends Controller
{
    public static function cadMesAction(array $post, array $get)
    {
        $mesID = (isset($post['mesID'])) ? $post['mesID'] : 0;
        $_SESSION['mesID'] = $mesID;
        parent::viewAction('cadMes');
    }

    public static function preencherArray(array $post)
    {
        $mes = Model\Mes::getArray();

        foreach($mes as $campo => $valor)
        {
            $mes[$campo] = $post[$campo];
        }

        return $mes;
    }

    public static function fecharMesAction()
    {
        parent::ViewAction('meses', 'fechamento');
    }

    public static function abrirMesAction()
    {
        parent::ViewAction('cadMes');
    }

    public static function fecharMes()
    {
        //
    }

    public static function atualizarMesAction(array $post, array $get)
    {
        $mes = self::preencherArray($post);

        if (!Model\Mes::validar($mes)){
            parent::ViewAction('cadMes');
            return;
        }

        if (Model\Mes::atualizar($mes)){
            parent::viewAction('meses');
        } else {
            $_SESSION['mensagem'] = 'Registro do Mês não atualizado.';
            parent::viewAction('cadMes');
        }
    }

    public static function gravarMesAction(array $post, array $get)
    {
        $post['mesID'] = 0;
        $mes = self::preencherArray($post);
        $mes['mesIDUsu'] = $_SESSION['usuID'];

        if (!Model\Mes::validar($mes)) {
            parent::viewAction('cadMes');
            return;
        }

        if (Model\Mes::gravar($mes)) {
            parent::viewAction('meses');
        } else {
            $_SESSION['mensagem'] = 'Registro do Mês não gravado.';
            parent::viewAction('cadMes');
        }
    }
}