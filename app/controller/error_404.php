<?php

class error_404 extends base_controller {

    public function index() {
        $title = title('Error 404');
        $sub_headline = 'Error 404';

        $data = array(
            'title' => $title,
            'header' => View::render('header', $sub_headline, array('sub_dir' => 'misc')),
            'content' => View::render('error_404', array('sub_headline' => 'hihihi'), array('sub_dir' => 'misc'))
        );

        View::layout('default', $data);
    }

}
