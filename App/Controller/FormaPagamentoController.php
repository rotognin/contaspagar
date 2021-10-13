<?php

namespace App\Controller;

use App\Model;

class FormaPagamentoController extends Controller
{
    public static function cadFormaPagamentoAction(array $post, array $get)
    {
        $fpgID = (isset($post['fpgID'])) ? $post['fpgID'] : 0;
        $_SESSION['fpgID'] = $fpgID;
        parent::viewAction('cadFormaPagamento');
    }

    public static function preencherArray(array $post)
    {
        $formaPagamento = Model\FormaPagamento::getArray();

        foreach($formaPagamento as $campo => $valor)
        {
            $formaPagamento[$campo] = $post[$campo];
        }

        return $formaPagamento;
    }

    public static function atualizarFormaPagamentoAction(array $post, array $get)
    {
        $formaPagamento = self::preencherArray($post);

        if (!Model\FormaPagamento::validar($formaPagamento)){
            parent::ViewAction('cadFormaPagamento');
            return;
        }

        if (Model\FormaPagamento::atualizar($formaPagamento)){
            parent::viewAction('formasPagamento');
        } else {
            $_SESSION['mensagem'] = 'Registro da Forma de Pagamento não atualizada.';
            parent::viewAction('cadFormaPagamento');
        }
    }

    public static function gravarFormaPagamentoAction(array $post, array $get)
    {
        $post['fpgID'] = 0;
        $formaPagamento = self::preencherArray($post);

        if (!Model\FormaPagamento::validar($formaPagamento)) {
            parent::viewAction('cadFormaPagamento');
            return;
        }

        if (Model\FormaPagamento::gravar($formaPagamento)) {
            parent::viewAction('formasPagamento');
        } else {
            $_SESSION['mensagem'] = 'Registro da Forma de Pagamento não gravado.';
            parent::viewAction('cadFormaPagamento');
        }
    }
}