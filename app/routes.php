<?php

Router::register('registered-route', 'home@registered_route');

Router::route('no-controller', function() {
    $title = title('No controller');
    $sub_headline = 'No controller was used to display this content';

    $data = array(
        'title' => $title,
        'header' => View::render('header', null, array('sub_dir' => 'misc')),
        'content' => View::render('index', array('sub_headline' => $sub_headline), array('sub_dir' => 'home'))
    );

    View::layout('default', $data);
});
