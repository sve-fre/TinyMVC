<?php

class Config {

    private static $cfgs = array();
    private static $loaded = false;

    private static function load() {
        $cfg_dir = ABS_PATH . 'app/config/';

        if ($handle = opendir($cfg_dir)) {
            while (false !== ($file = readdir($handle))) {
                if ($file !== '.' && $file !== '..') {
                    $filename = substr($file, 0, -4);

                    if (is_readable($cfg_dir . $file)) {
                        self::$cfgs[$filename] = include $cfg_dir . $file;
                    }
                }
            }
            closedir($handle);
            self::$loaded = true;
        }
    }

    public static function get($item = null) {
        if (!isset($item)) {
            return null;
        }

        if (self::$loaded === false) {
            self::load();
        }

        if (strpos($item, '.') !== true && isset(self::$cfgs[$item])) {
            return self::$cfgs[$item];
        } else {
            $items = explode('.', $item);

            if (!isset(self::$cfgs[$items[0]])) {
                return null;
            }

            $array = self::$cfgs[$items[0]];

            array_shift($items);

            foreach ($items as $number => $key) {
                $array = (isset($array[$key])) ? $array[$key] : null;
            }

            return $array;
        }
    }

}
