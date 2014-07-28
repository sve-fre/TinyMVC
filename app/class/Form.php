<?php

class Form {

    private static $_fields = array();
    private static $_output = array();
    private static $_rules = array();
    private static $_method = '';
    private static $_errors = array();


    public static function make($action, $method, $attributes = array()) {
        self::$_fields = self::$_output = self::$_errors = array();
        self::$_method = $method;
        self::$_output[] = View::render('form_open', array(
            'action' => $action,
            'method' => $method,
            'attributes' => stringifyHTMLAttributes($attributes)
        ), array(
            'sub_dir' => array('template', 'form')
        ));
    }


    public static function input($type, $name, $attributes = array()) {
        if (!in_array($type, array('color', 'date', 'datetime', 'datetime-local', 'email', 'month', 'number', 'range', 'search', 'tel', 'time', 'url', 'week', 'text', 'password', 'checkbox', 'radio', 'submit', 'reset', 'file', 'hidden', 'image', 'button'))) {
            $type = 'text';
        }

        self::$_fields[$name] = array(
            'type' => $type,
            'name' => $name,
            'attributes' => $attributes
        );
    }


    public static function hasErrors() {
        return (count(self::$_errors));
    }


    private static function _render($type, $name, $attributes = array()) {
        if (isset(self::$_errors[$name])) {
            if (isset($attributes['class'])) {
                $attributes['class'] = $attributes['class'] . ' error';
            } else {
                $attributes['class'] = 'error';
            }
        }

        return View::render('input', array(
            'type' => $type,
            'name' => $name,
            'value' => (array_key_exists('value', $attributes) ? $attributes['value'] : ((isset($_POST[$name]) && !empty($_POST[$name])) ? $_POST[$name] : '')),
            'attributes' => stringifyHTMLAttributes($attributes)
        ), array(
            'sub_dir' => array('template', 'form')
        ));
    }


    private static function _validate($rules) {
        foreach ($rules as $name => $conditions) {
            $method = (strtolower(self::$_method) == 'post') ? $_POST : $_GET;
            $field = isset($method[$name]) ? $method[$name] : null;

            if ($field !== null) {
                foreach ($conditions as $condition) {
                    // required
                    if ($condition == 'required' && empty($field)) {
                        self::$_errors[$name]['required'] = true;
                    }

                    // min length
                    if (is_string($field) && String::contains($condition, 'min:')) {
                        $min = (int)explode(':', $condition)[1];

                        if (strlen($field) < $min) {
                            self::$_errors[$name]['min'] = true;
                        }
                    }

                    // max length
                    if (is_string($field) && String::contains($condition, 'max:')) {
                        $max = (int)explode(':', $condition)[1];

                        if (strlen($field) > $max) {
                            self::$_errors[$name]['max'] = true;
                        }
                    }

                    // alpha-numeric (alnum)
                    if ($condition == 'alnum' && !ctype_alnum($field)) {
                        self::$_errors[$name]['alnum'] = true;
                    }

                    // alpha-numeric + dash (alnumdash)
                    if ($condition == 'alnumdash' && !preg_match("/^[a-zA-Z0-9-]+$/", $field)) {
                        self::$_errors[$name]['alnumdash'] = true;
                    }

                    // alpha-numeric + underscore (alnumdash)
                    if ($condition == 'alnumus' && !preg_match("/^[a-zA-Z0-9_]+$/", $field)) {
                        self::$_errors[$name]['alnumus'] = true;
                    }
                }
            }
        }
    }


    public static function rules($rules) {
        self::$_rules = $rules;
    }


    public static function get() {
        if (count(self::$_rules)) {
            self::_validate(self::$_rules);
        }

        foreach (self::$_fields as $field) {
            self::$_output[] = self::_render($field['type'], $field['name'], $field['attributes']);
        }

        return implode('', self::$_output) . '</form>';
    }


    public static function getErrors() {
        return self::$_errors;
    }

}
