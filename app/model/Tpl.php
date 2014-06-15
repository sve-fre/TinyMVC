<?php

class Tpl {

    public function header($data = null) {
        return View::render('header', $data, array('sub_dir' => 'misc'));
    }


    public function content($data = null) {
        return View::render('index', $data, array('sub_dir' => 'home'));
    }

}
