<?php

class Form {

    private static $_action = null;
    private static $_method = null;
    private static $_output = '';


    public static function make($action, $method, $callback, $attributes = array()) {
        self::$_action = $action;
        self::$_method = $method;
        self::$_output = View::render('form_open', array(
            'action' => $action,
            'method' => $method,
            'attributes' => $attributes
        ), array(
            'sub_dir' => array('template', 'form')
        ));

        if (is_callable($callback)) {
            $callback(new self);
        }

        return self::$_output;
    }


    public function textfield($name, $attributes = array()) {
        self::$_output .= View::render('textfield', array(
            'name' => $name,
            'attributes' => $attributes
        ), array(
            'sub_dir' => array('template', 'form')
        ));
    }

}
