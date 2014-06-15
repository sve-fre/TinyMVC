<?php

class Model {

    public static function get($model) {
        $model_file = path('model') . $model . '.php';

        if (File::isReadable($model_file)) {
            require_once $model_file;

            return new $model;
        }
    }

}
