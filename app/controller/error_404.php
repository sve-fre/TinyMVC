<?php

class error_404 extends base_controller {

    public function index() {
        $tpl = Model::get('Template');
        $data = array(
            'title' => title('Error 404'),
            'header' => $tpl->header(),
            'content' => $tpl->content(array('content' => 'Oops, something went wrong.')),
            'footer' => $tpl->footer()
        );

        View::layout(self::$layout, $data);
    }

}
