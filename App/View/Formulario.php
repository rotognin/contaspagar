<?php

namespace App\View;

class Formulario
{

    /**
     * Montagem de um campo de formulário "Input Text"
     * Passar os parâmetros: label, id (name), value, autofocus (bool), 
     * required (bool), readonly (bool), size (padrão "50")
     */
    public static function inputText(array $config)
    {
        $html = '';
        $id = '';

        $label     = (array_key_exists('label', $config))     ? $config['label'] : '';
        $id        = $config['id'];
        $autofocus = (array_key_exists('autofocus', $config)) ? ' autofocus '    : '';
        $required  = (array_key_exists('required', $config))  ?  ' required '    : '';
        $readonly  = (array_key_exists('readonly', $config))  ? ' readonly '     : '';
        $value     = (array_key_exists('value', $config))     ? $config['value'] : '';
        $size      = (array_key_exists('size', $config))      ? $config['size']  : '50';

        $html  = '<label for="' . $id . '">' . $label . '&nbsp;&nbsp;</label>';
        $html .= '<input type="text" id="' . $id . '" name="' . $id . '" value="' . $value . '" ';
        $html .= $autofocus . $required . $readonly . ' size="' . $size . '">';

        return $html;
    }

    /**
     * Montagem de um campo de formulário "Input Radio"
     * Será montado um a um, ou seja, para cada botão, uma chamada à função é necessária.
     * Passar os parâmetros: label, name, value, campo
     * - Se o campo for igual ao value, irá marcar o botão
     */
    public static function inputRadio(array $config)
    {
        $html  = '';
        $label = $config['label'];
        $name  = $config['name'];
        $value = $config['value'];
        $id    = $name . $value;
        $campo = $config['campo'];
        $checked = ($config['campo'] == $value) ? ' checked ' : '';

        $html  = '<input type="radio" id="' . $id . '" name="' . $name . '" value="' . $value . '" ';
        $html .= $checked . '>';
        $html .= '<label for="' . $id . '">&nbsp;&nbsp;' . $label . '</label>';

        return $html;
    }
}

