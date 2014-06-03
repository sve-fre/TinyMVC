<?php

class Dir {

    public static function isReadable($dir) {
        return (File::isReadable($dir) && is_dir($dir));
    }


    public static function exists($dir) {
        return (File::exists($dir) && is_dir($dir));
    }


    public static function read($dir, $callback = null) {
        if (!Dir::isReadable($dir)) {
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
