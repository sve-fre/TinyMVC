<?php

class Form {

    private static $_action = null;
    private static $_method = null;
    private static $_output = array();
    private static $_form_close = '</form>';


    public static function make($action, $method, $callback, $attributes = array()) {
        self::$_action = $action;
        self::$_method = $method;
        self::$_output[] = View::render('form_open', array(
            'action' => $action,
            'method' => $method,
            'attributes' => $attributes
        ), array(
            'sub_dir' => array('template', 'form')
        ));

        if (is_callable($callback)) {
            $callback(new self);
        }

        return implode('', self::$_output) . self::$_form_close;
    }


    public function textfield($name, $attributes = array()) {
        self::$_output[] = View::render('textfield', array(
            'name' => $name,
            'attributes' => $attributes
        ), array(
            'sub_dir' => array('template', 'form')
        ));

        return $this;
    }


    public function textarea($name, $attributes = array()) {
        $value = (array_key_exists('value', $attributes)) ? $attributes['value'] : '';

        if (array_key_exists('value', $attributes)) {
            unset($attributes['value']);
        }

        self::$_output[] = View::render('textarea', array(
            'name' => $name,
            'value' => $value,
            'attributes' => $attributes
        ), array(
            'sub_dir' => array('template', 'form')
        ));

        return $this;
    }


    public function wrap($wrapper, $attributes = array()) {
        $num = count(self::$_output);

        if (!isset(self::$_output[$num - 1])) {
            return;
        }

        $output = '<' . $wrapper;

        if (count($attributes)) {
            $output .= stringifyHTMLAttributes($attributes);
        }

        $output .= '>' . self::$_output[$num - 1] . '</' . $wrapper . '>';
        self::$_output[$num - 1] = $output;
    }

}
