<?php

class Template {

    public function header($data = null) {
        return View::render('header', $data, array('sub_dir' => 'misc'));
    }


    public function content($data = null) {
        return View::render('index', $data, array('sub_dir' => 'home'));
    }


    public function footer($data = null) {
        return View::render('footer', $data, array('sub_dir' => 'misc'));
    }

}
