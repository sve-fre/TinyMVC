<?php

Router::register('logout', 'dashboard@logout');

Router::route('home/about', function() {
    $tpl = Model::get('Template');
    $data = array(
        'title' => title('About'),
        'header' => $tpl->header(),
        'content' => $tpl->content(array('content' => 'About.')),
        'footer' => $tpl->footer()
    );

    View::layout('default', $data);
});

Router::route('ricknroll', function() {
    echo HTML::make('p', function() {
        return 'You found a secret.';
    });
});
