<?php

class Model {

    public static function get($model) {
        $model_file = path('model') . $model . '.php';

        if (is_readable($model_file)) {
            require_once $model_file;

            return new $model;
        }
    }

}
