<?php

function path($path = '') {
    if (!$path) {
        return ABS_PATH;
    }

    $valid_paths = array(
        'app' => ABS_PATH . 'app',
        'class' => ABS_PATH . 'app' . DS . 'class',
        'config' => ABS_PATH . 'app' . DS . 'config',
        'controller' => ABS_PATH . 'app' . DS . 'controller',
        'model' => ABS_PATH . 'app' . DS . 'model',
        'plugin' => ABS_PATH . 'app' . DS . 'plugin',
        'storage' => ABS_PATH . 'app' . DS . 'storage',
        'view' => ABS_PATH . 'app' . DS . 'view'
    );

    return (array_key_exists($path, $valid_paths)) ? $valid_paths[$path] . DS : ABS_PATH;
}

function url($url = '') {
    $base_url = Config::get('app.base_url');

    if (!$url) {
        return $base_url;
    }

    return (Config::get('app.mod_rewrite') === false) ? $base_url . 'index.php?' . $url : $base_url . $url;
}

function slug($str) {
    $str = mb_strtolower(trim($str));
    $str = strip_tags($str);

    $find = array('ä', 'á', 'à', 'ü', 'ö', 'ß', 'é', 'è');
    $replace = array('ae', 'a', 'a', 'ue', 'oe', 'e', 'e');
    $str = str_replace($find, $replace, $str);

    $str = preg_replace('/[^a-z0-9-]/', '-', $str);
    $str = preg_replace('/-+/', '-', $str);
    $str = trim($str, '-');

    return $str;
}

function title($title = '') {
    if (!$title) {
        return Config::get('app.title');
    }

    return $title . Config::get('app.title_separator') . Config::get('app.title');
}

function d() {
    array_map(
        function($x) {
            echo '<pre style="font: 14px/1.4 monospace; margin: 1em; padding: .5em; border: 1px solid #ddd; background-color: #fff; color: #000; overflow: auto;">';
            var_dump($x);
            echo '</pre>';
        }, func_get_args()
    );
}

function protect($str) {
    return mysql_real_escape_string(strip_tags(trim($str)));
}

function backtick($value) {
    return (is_string($value) && strpos($value, '.') === false) ? '`' . $value . '`' : $value;
}

function quote($value) {
    return (is_string($value)) ? '"' . $value . '"' : $value;
}

function getData($uri) {
    $local_path = realpath(dirname($uri));

    if ($local_path) {
        return ($content = file_get_contents($uri)) ? $content : '';
    } else {
        if (in_array('curl', get_loaded_extensions())) {
            $ch = curl_init();
            $timeout = 5;
            curl_setopt($ch, CURLOPT_URL, $uri);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            $data = curl_exec($ch);
            curl_close($ch);

            return $data;
        } elseif (ini_get('allow_url_fopen')) {
            return ($content = file_get_contents($uri)) ? $content : false;
        }

        return false;
    }
}

function stringifyHTMLAttributes($attributes = array(), $is_submit = false) {
    $output = '';

    if ($is_submit && isset($attributes['value'])) {
        unset($attributes['value']);
    }

    if (count($attributes)) {
        foreach ($attributes as $property => $value) {
            $output .= ' ' . $property . '=' . '"' . $value . '"';
        }
    }

    return $output;
}

function sql($type, $name = '', $options = array()) {
    switch ($type) {
        case 'int':
        case 'integer':
            return $name . ' INT';
            break;
        case 'tinyint':
        case 'tinyinteger':
        case 'tinyInt':
        case 'tinyInteger':
            return $name . ' TINYINT';
            break;
        case 'bigint':
        case 'biginteger':
        case 'bigInt':
        case 'biginteger':
            return $name . ' BIGINT';
            break;
        case 'float':
            return $name . ' FLOAT';
            break;
        case 'double':
            return $name . ' DOUBLE';
            break;
        case 'var':
        case 'varchar':
            return $name . ' VARCHAR (' . ((isset($options['length']) && is_numeric($options['length']) && $options['length'] <= 255) ? (int)$options['length'] : 255) . ')';
            break;
        case 'text':
            return $name . ' TEXT';
            break;
        case 'date':
            return $name . ' DATE';
            break;
        case 'datetime':
            return $name . ' DATETIME';
            break;
        case 'timestamp':
            return $name . ' TIMESTAMP';
        case 'time':
            return $name . ' TIME';
            break;
        case 'id':
            return 'id INT NOT NULL AUTO_INCREMENT PRIMARY KEY';
    }
}
