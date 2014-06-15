<?php

class home extends base_controller {

    public function index() {
        $tpl = Model::get('Template');
        $data = array(
            'title' => title(),
            'header' => $tpl->header(),
            'content' => $tpl->content(array('content' => 'Index.')),
            'footer' => $tpl->footer()
        );

        View::layout(self::$layout, $data);
    }

}
