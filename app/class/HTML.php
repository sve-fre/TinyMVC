<?php

class HTML {

    private static $_closed = false;
    private static $_output = '';

    public static function make($tag, $attributes = array(), $callback = null) {
        self::$_output = '<' . $tag;

        if (func_num_args() > 1) {
            if (is_array(func_get_arg(1))) {
                $attributes = func_get_arg(1);

                if (count($attributes)) {
                    foreach ($attributes as $attribute => $value) {
                        self::$_output .= ' ' . $attribute . '="' . $value . '"';
                    }

                    self::$_output .= '>';
                    self::$_closed = true;
                }
            } elseif (is_callable(func_get_arg(1))) {
                self::$_output .= self::_callback(func_get_arg(1));
            }
        }

        if ($callback && is_callable($callback)) {
            self::$_output .= self::_callback($callback);
        }

        if (!self::$_closed) {
            self::$_output .= '>';
            self::$_closed = true;
        }

        self::$_output .= '</' . $tag . '>';
        $output = self::$_output;
        self::$_output = '';
        self::$_closed = false;

        return $output;
    }

    private static function _callback($callback) {
        if (!self::$_closed) {
            self::$_output .= '>';
            self::$_closed = true;
        }

        return $callback();
    }

}
