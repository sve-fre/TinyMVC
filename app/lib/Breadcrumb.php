<?php

class Breadcrumb {

    public static function get($config = array()) {
        $parts = array_values(Request::segments());
        $output = '';

        $show_home = array_key_exists('show_home', $config) ? filter_var($config['show_home'], FILTER_VALIDATE_BOOLEAN) : true;
        $home_title = array_key_exists('home_title', $config) ? $config['home_title'] : 'Home';

        $output = '<ul id="breadcrumb">';

        if ($show_home) {
            $output .= '<li><a href="' . url() . '">' . $home_title . '</a></li>';
        }

        if (count($parts)) {
            for ($i = 0; $i < count($parts); $i++) {
                if ($parts[$i] == Config::get('app.default_controller')) {
                    continue;
                }

                $url = url(implode('/', array_slice($parts, 0, $i + 1)));
                $output .= '<li><a href="' . $url . '">' . $parts[$i] . '</a></li>';
            }
        }

        $output .= '</ul>';

        return $output;
    }

}
