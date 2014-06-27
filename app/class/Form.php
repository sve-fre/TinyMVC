<?php

class Form {

    private static $_action = null;
    private static $_method = null;
    private static $_output = array();
    private static $_form_close = '</form>';
    private static $_fields = array();


    public static function make($action, $method, $callback, $attributes = array()) {
        self::$_action = $action;
        self::$_method = $method;
        self::$_output[] = View::render('form_open', array(
            'action' => $action,
            'method' => $method,
            'attributes' => stringifyHTMLAttributes($attributes)
        ), array(
            'sub_dir' => array('template', 'form')
        ));

        if (is_callable($callback)) {
            $callback(new self);
        }

        $output = self::$_output;
        self::$_output = array();

        return implode('', $output) . self::$_form_close;
    }


    public function input($type, $name, $attributes = array()) {
        if (!in_array($type, array('color', 'date', 'datetime', 'datetime-local', 'email', 'month', 'number', 'range', 'search', 'tel', 'time', 'url', 'week', 'text', 'password', 'checkbox', 'radio', 'submit', 'reset', 'file', 'hidden', 'image', 'button'))) {
            $type = 'text';
        }

        self::$_fields[$name] = array(
            'type' => $type,
            'name' => $name,
            'attributes' => $attributes
        );

        self::$_output[] = View::render('input', array(
            'type' => $type,
            'name' => $name,
            'value' => (array_key_exists('value', $attributes) ? $attributes['value'] : ((isset($_POST[$name]) && !empty($_POST[$name])) ? $_POST[$name] : '')),
            'attributes' => stringifyHTMLAttributes($attributes)
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

        self::$_fields[$name] = array(
            'name' => $name,
            'attributes' => $attributes
        );

        self::$_output[] = View::render('textarea', array(
            'name' => $name,
            'value' => $value,
            'attributes' => stringifyHTMLAttributes($attributes)
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

        return $this;
    }


    public function rules($rules) {
        $field = end(self::$_fields);

        if (isset($_POST[$field['name']])) {
            if (is_array($rules) && count($rules)) {
                foreach ($rules as $rule) {
                    self::_validateRule($rule);
                }

                return $this;
            }

            self::_validateRule($rules);
        }

        return $this;
    }


    private function _validateRule($rule) {
        $field = end(self::$_fields);

        if ($rule === 'required') {
            if (empty($_POST[$field['name']])) {
                self::$_fields[$field['name']]['errors']['required'] = 'The ' . $field['name'] . ' field is required.';
            }
        }

        if (String::contains($rule, 'min:')) {
            $min = (int)explode(':', $rule)[1];

            if (strlen($_POST[$field['name']]) <= $min) {
                self::$_fields[$field['name']]['errors']['min'] = 'The ' . $field['name'] . ' has to have a minimum length of ' . $min . '.';
            }
        }

        if (String::contains($rule, 'max:')) {
            $max = (int)explode(':', $rule)[1];

            if (strlen($_POST[$field['name']]) >= $max) {
                self::$_fields[$field['name']]['errors']['min'] = 'The ' . $field['name'] . ' has to have a maximum length of ' . $max . '.';
            }
        }
    }

}
