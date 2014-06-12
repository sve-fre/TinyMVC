<?php

Router::register('registered-route', 'home@registered_route');
Router::register('home/about/lala', 'home@lala');

Router::route('ricknroll', function() {
    echo HTML::make('p', function() {
        return 'You found a secret.';
    });
});

Router::route('no-controller', function() {
    $title = title('No controller');
    $sub_headline = 'No controller was used to display this content';
    $breadcrumb = Breadcrumb::get();

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

    View::layout('default', $data);
});
