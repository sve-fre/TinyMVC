<?php

class home extends base_controller {

    public function index() {
        $form = Form::make('/', 'POST', function($form) {
            $form->textfield('name')->wrap('div', array('class' => 'textfield-wrapper'));
            $form->textarea('text')->wrap('div', array('class' => 'textarea-wrapper'));
        }, array(
            'class' => 'name-form'
        ));

        $data = array(
            'title' => title(),
            'header' => $this->tpl->header(),
            'content' => $this->tpl->content(array('content' => $form)),
            'footer' => $this->tpl->footer()
        );

        View::layout($this->layout, $data);
    }

}
