<?php

function canonical_element__view_render($view, $data) {
    echo 'canonical_element__plugin() was called';
    d($view);
    d($data);
}

function canonical_element__view_layout($layout, $data) {
    echo 'canonical_element__view_layout() was called';
}
