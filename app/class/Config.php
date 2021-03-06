<?php

class Config {

    private static $_cfgs = array();
    private static $_loaded = false;


    public static function set($key, $value) {
        if (String::contains($key, '.')) {
            $parts = explode('.', $key);
            $num = count($parts);

            switch ($num) {
                case 1:
                    self::$_cfgs[$parts[0]] = $value;
                break;

                case 2:
                    self::$_cfgs[$parts[0]][$parts[1]] = $value;
                break;

                case 3:
                    self::$_cfgs[$parts[0]][$parts[1]][$parts[2]] = $value;
                break;

                case 4:
                    self::$_cfgs[$parts[0]][$parts[1]][$parts[2]][$parts[3]] = $value;
                break;

                default:
                    self::$_cfgs[$parts[0]] = $value;
            }

            return true;
        }

        self::$_cfgs[$key] = $value;
    }


    private static function load() {
        Dir::read(path('config'), function($files) {
            if ($files && count($files)) {
                foreach ($files as $file) {
                    if (File::exists($file['file_path']) && File::isReadable($file['file_path'])) {
                        self::$_cfgs[substr($file['file_name'], 0, -4)] = include $file['file_path'];
                    }
                }
                self::$_loaded = true;
            }
        });
    }


    public static function get($item = null) {
        if (!isset($item)) {
            return null;
        }

        if (self::$_loaded === false) {
            self::load();
        }

        if (!String::contains($item, '.') && isset(self::$_cfgs[$item])) {
            return self::$_cfgs[$item];
        } else {
            $items = explode('.', $item);

            if (!isset(self::$_cfgs[$items[0]])) {
                return null;
            }

            $array = self::$_cfgs[$items[0]];
            array_shift($items);

            foreach ($items as $number => $key) {
                $array = (isset($array[$key])) ? $array[$key] : null;
            }

            return $array;
        }
    }


    public static function all() {
        return self::$_cfgs;
    }

}
