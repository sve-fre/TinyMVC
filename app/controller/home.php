<?php

class home extends base_controller {

    public function index() {
        $title = title();
        $sub_headline = 'This comes from home@index.';
        $Lorem_Model = Model::get('Lorem');
        $lorem_text = $Lorem_Model::getMessage();
        $breadcrumb = Breadcrumb::get(self::$breadcrumb_config);
        $h1 = HTML::make('h1', array('class' => 'foo', 'title' => 'Title'), function() {
            return '<code>$h1 = HTML::make(\'h1\', array(\'class\' => \'foo\', \'title\' => \'Title\'), function() { return \'Content\'; });</code>';
        });

        $data = array(
            'title' => $title,
            'header' => View::render('header', null, array('sub_dir' => 'misc')),
            'content' => View::render(
                'index',
                array(
                    'sub_headline' => $sub_headline,
                    'model' => $lorem_text,
                    'h1' => $h1,
                    'breadcrumb' => $breadcrumb
                ),
                array('sub_dir' => 'home')
            )
        );

        View::layout(self::$layout, $data);
    }


    public function about() {
        $title = title('About');
        $sub_headline = 'This comes from home@about.';
        $breadcrumb = Breadcrumb::get(self::$breadcrumb_config);

        $data = array(
            'title' => $title,
            'header' => View::render('header', null, array('sub_dir' => 'misc')),
            'content' => View::render(
                'index',
                array(
                    'sub_headline' => $sub_headline,
                    'breadcrumb' => $breadcrumb
                ),
                array('sub_dir' => 'home')
            )
        );

        View::layout(self::$layout, $data);
    }


    public function lala() {
        $title = title('Lala');
        $sub_headline = 'This comes from home@lala.';
        $breadcrumb = Breadcrumb::get(self::$breadcrumb_config);

        $data = array(
            'title' => $title,
            'header' => View::render('header', null, array('sub_dir' => 'misc')),
            'content' => View::render(
                'index',
                array(
                    'sub_headline' => $sub_headline,
                    'breadcrumb' => $breadcrumb
                ),
                array('sub_dir' => 'home')
            )
        );

        View::layout(self::$layout, $data);
    }


    public function registered_route() {
        $title = title('Registered route');
        $sub_headline = 'This was registered in <code>routes.php</code> via <code>Router::register(\'registered-route\', \'home@registered_route\');</code>.';
        $breadcrumb = Breadcrumb::get(self::$breadcrumb_config);

        $data = array(
            'title' => $title,
            'header' => View::render('header', null, array('sub_dir' => 'misc')),
            'content' => View::render(
                'index',
                array(
                    'sub_headline' => $sub_headline,
                    'breadcrumb' => $breadcrumb
                ),
                array('sub_dir' => 'home')
            )
        );

        View::layout(self::$layout, $data);
    }

}
