<?php

class error_404 {

    public function index() {
        View::layout('default', ['title' => 'TinyMVC | Error 404'], function($layout) {
            $layout = str_replace('{{header}}', View::render('header', null, ['sub_dir' => 'misc']), $layout);
            $layout = str_replace('{{content}}', View::render('error_404', null, ['sub_dir' => 'misc']), $layout);
            echo $layout;
        });
    }

}
