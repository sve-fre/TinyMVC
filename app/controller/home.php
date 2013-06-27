<?php

class home {

    public function index() {
        $title = title();

        View::layout('default', ['title' => $title], function($layout) {
            $data = ['sub_headline' => 'This text comes from a controller (' . Request::controller() . ')'];

            $layout = str_replace('{{header}}', View::render('header', null, ['sub_dir' => 'misc']), $layout);
            $layout = str_replace('{{content}}', View::render('index', $data, ['sub_dir' => 'home']), $layout);
            echo $layout;
        });
    }

    public function about() {
        $title = title('About');

        View::layout('default', ['title' => $title], function($layout) {
            $data = ['sub_headline' => 'It\'s really easy and super fast and tiny.'];

            $layout = str_replace('{{header}}', View::render('header', null, ['sub_dir' => 'misc']), $layout);
            $layout = str_replace('{{content}}', View::render('index', $data, ['sub_dir' => 'home']), $layout);
            echo $layout;
        });
    }

    public function testroute() {
        $title = title('TestRoute');

        View::layout('default', ['title' => $title], function($layout) {
            $data = ['sub_headline' => 'It\'s really easy and super fast and tiny.'];

            $layout = str_replace('{{header}}', View::render('header', null, ['sub_dir' => 'misc']), $layout);
            $layout = str_replace('{{content}}', View::render('testroute', $data, ['sub_dir' => 'misc']), $layout);
            echo $layout;
        });
    }

    public function testroute_asd() {
        $title = title('TestRoute ASD');

        View::layout('default', ['title' => $title], function($layout) {
            $data = ['sub_headline' => 'It\'s really easy and super fast and tiny.'];

            $layout = str_replace('{{header}}', View::render('header', null, ['sub_dir' => 'misc']), $layout);
            $layout = str_replace('{{content}}', View::render('testroute_asd', $data, ['sub_dir' => 'misc']), $layout);
            echo $layout;
        });
    }

    public function another_route() {
        $title = title('Another Route');

        $data = [
            'title' => $title,
            'header' => View::render('header', null, ['sub_dir' => 'misc']),
            'content' => View::render('index', ['sub_headline' => 'hihihi'], ['sub_dir' => 'home'])
        ];

        View::layout('no_placeholders', $data);
    }

}
