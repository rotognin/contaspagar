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

        $html  = '<label for="' . $id . '">' . $label . '</label>';
        $html .= '<input type="text" id="' . $id . '" name="' . $id . '" value="' . $value . '" ';
        $html .= $autofocus . $required . $readonly . ' size="' . $size . '">';

        return $html;
    }

    public static function inputRadio(array $config)
    {
        // Implementar o tipo Radio
    }
}

