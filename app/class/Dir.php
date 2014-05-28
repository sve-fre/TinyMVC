<?php

class Dir {

    public static function read($dir, $callback = null) {
        if (!is_readable($dir)) {
            return false;
        }

        $result = array();
        $i = 0;

        if ($handle = opendir($dir)) {
            while (false !== ($file = readdir($handle))) {
                if ($file != '.' && $file != '..') {
                    $result[$i]['file_name'] = $file;
                    $result[$i]['file_path'] = $dir . $file;
                }

                $i++;
            }
            closedir($handle);

            if ($callback && is_callable($callback)) {
                return $callback($result);
            }
        }

        return (!count($result)) ? false : $result;
    }

}
