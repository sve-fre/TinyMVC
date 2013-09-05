<?php

class home extends base_controller {

    public function index() {
        $title = title();
        $sub_headline = 'This is a sub headline';
        $Lorem_Model = Model::get('Lorem');
        $lorem_text = $Lorem_Model::getMessage();
        $h1 = HTML::make('h1', array('class' => 'foo', 'title' => 'Title'), function() {
            return '<code>$h1 = HTML::make(\'h1\', array(\'class\' => \'foo\', \'title\' => \'Title\'), function() { return \'Content\'; });<code>';
        });

        $data = array(
            'title' => $title,
            'header' => View::render('header', null, array('sub_dir' => 'misc')),
            'content' => View::render('index', array('sub_headline' => $sub_headline . $lorem_text . $h1), array('sub_dir' => 'home'))
        );

        View::layout(self::$layout, $data);
    }


    public function about() {
        $title = title('About');
        $sub_headline = 'This comes from home@about';

        $data = array(
            'title' => $title,
            'header' => View::render('header', null, array('sub_dir' => 'misc')),
            'content' => View::render('index', array('sub_headline' => $sub_headline), array('sub_dir' => 'home'))
        );

        View::layout(self::$layout, $data);
    }


    public function registered_route() {
        $title = title('Registered route');
        $sub_headline = 'This was registered in <code>routes.php</code> via <code>Router::register(\'registered-route\', \'home@registered_route\');</code>';

        $data = array(
            'title' => $title,
            'header' => View::render('header', null, array('sub_dir' => 'misc')),
            'content' => View::render('index', array('sub_headline' => $sub_headline), array('sub_dir' => 'home'))
        );

        View::layout(self::$layout, $data);
    }

}
