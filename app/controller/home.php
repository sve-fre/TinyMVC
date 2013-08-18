<?php

class home {

    public function index() {
        $title = title();
        $sub_headline = 'This is a sub headline';

        $data = array(
            'title' => $title,
            'header' => View::render('header', null, array('sub_dir' => 'misc')),
            'content' => View::render('index', array('sub_headline' => $sub_headline), array('sub_dir' => 'home'))
        );

        View::layout('default', $data);
    }


    public function about() {
        $title = title();
        $sub_headline = 'This comes from home@about';

        $data = array(
            'title' => $title,
            'header' => View::render('header', null, array('sub_dir' => 'misc')),
            'content' => View::render('index', array('sub_headline' => $sub_headline), array('sub_dir' => 'home'))
        );

        View::layout('default', $data);
    }


    public function iwasregistered() {
        $title = title();
        $sub_headline = 'This was registered in <code>init.php</code> via <code>Router::register(\'iwasregistered\', \'home@iwasregistered\');</code>';

        $data = array(
            'title' => $title,
            'header' => View::render('header', null, array('sub_dir' => 'misc')),
            'content' => View::render('index', array('sub_headline' => $sub_headline), array('sub_dir' => 'home'))
        );

        View::layout('default', $data);
    }

}
