<?php

class error_404 extends base_controller {

    public function index() {
        $data = array(
            'title' => title('Error 404'),
            'header' => $this->tpl->header(),
            'content' => $this->tpl->content(array('content' => 'Oops, something went wrong.')),
            'footer' => $this->tpl->footer()
        );

        View::layout($this->layout, $data);
    }

}
