<?php

class error_404 {

    public function index() {
        $title = title('Error 404');
        $sub_headline = 'Error 404';

        $data = [
            'title' => $title,
            'header' => View::render('header', $sub_headline, ['sub_dir' => 'misc']),
            'content' => View::render('error_404', ['sub_headline' => 'hihihi'], ['sub_dir' => 'misc'])
        ];

        View::layout('default', $data);
    }

}
