<?php

Router::route('home/about', function() {
    $tpl = Model::get('Tpl');
    $data = array(
        'title' => title('About'),
        'header' => $tpl->header(),
        'content' => $tpl->content(array('content' => 'About.'))
    );

    View::layout('default', $data);
});

Router::route('ricknroll', function() {
    echo HTML::make('p', function() {
        return 'You found a secret.';
    });
});
