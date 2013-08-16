<?php

class home {

    public function index() {
        $title = title();
        $sub_headline = 'This is a sub headline';

        $data = [
            'title' => $title,
            'header' => View::render('header', $sub_headline, ['sub_dir' => 'misc']),
            'content' => View::render('index', ['sub_headline' => 'hihihi'], ['sub_dir' => 'home'])
        ];

        View::layout('default', $data);
    }


    public function iwasregistered() {
        echo 123;
    }

}
