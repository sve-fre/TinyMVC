<?php

function canonical_element__view_render($view, &$data) {
    if ($view == 'index') {
        $plugin_data = array(1, 2, 3, 4, 5, 6);

        return $plugin_data;
    }
}
