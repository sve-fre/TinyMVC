<?php

function meta__layout_render(&$data) {
    $data['meta_keywords'] = '<meta name="keywords" content="php, mvc, tinymvc, framework">';
    $data['meta_description'] = '<meta name="description" content="TinyMVC is a small PHP-based MVC-Framework.">';

    return $data;
}
