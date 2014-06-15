<?php

class home extends base_controller {

    public function index() {
        $tpl = Model::get('Tpl');
        $data = array(
            'title' => title(),
            'header' => $tpl->header(),
            'content' => $tpl->content(array('content' => 'Index.'))
        );

        View::layout(self::$layout, $data);
    }

}
