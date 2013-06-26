<?php

class home {

    public function index() {
        View::layout('default', ['title' => 'TinyMVC'], function($layout) {
            $data = ['sub_headline' => 'This text comes from a controller (' . Request::controller() . ')'];

            $layout = str_replace('{{header}}', View::render('header', null, ['sub_dir' => 'misc']), $layout);
            $layout = str_replace('{{content}}', View::render('index', $data, ['sub_dir' => 'home']), $layout);
            echo $layout;
        });
    }

    public function about() {
        View::layout('default', ['title' => 'TinyMVC | About'], function($layout) {
            $data = ['sub_headline' => 'It\'s really easy and super fast and tiny.'];

            $layout = str_replace('{{header}}', View::render('header', null, ['sub_dir' => 'misc']), $layout);
            $layout = str_replace('{{content}}', View::render('index', $data, ['sub_dir' => 'home']), $layout);
            echo $layout;
        });
    }

    public function testroute() {
        View::layout('default', ['title' => 'TinyMVC | TestRoute'], function($layout) {
            $data = ['sub_headline' => 'It\'s really easy and super fast and tiny.'];

            $layout = str_replace('{{header}}', View::render('header', null, ['sub_dir' => 'misc']), $layout);
            $layout = str_replace('{{content}}', View::render('testroute', $data, ['sub_dir' => 'misc']), $layout);
            echo $layout;
        });
    }

    public function testroute_asd() {
        View::layout('default', ['title' => 'TinyMVC | TestRoute ASD'], function($layout) {
            $data = ['sub_headline' => 'It\'s really easy and super fast and tiny.'];

            $layout = str_replace('{{header}}', View::render('header', null, ['sub_dir' => 'misc']), $layout);
            $layout = str_replace('{{content}}', View::render('testroute_asd', $data, ['sub_dir' => 'misc']), $layout);
            echo $layout;
        });
    }

}
