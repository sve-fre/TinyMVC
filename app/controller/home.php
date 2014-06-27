<?php

class home extends base_controller {

    public function index() {
        $form = Form::make('', 'POST', function($form) {
            $form
                ->input('text', 'name')
                ->rules(array('required', 'min:3', 'max:30'))
                ->wrap('div', array('class' => 'textfield-wrapper'));
            $form->input('password', 'password')->wrap('div', array('class' => 'textfield-wrapper'));
            $form->input('submit', 'login_form_submit', array('value' => 'OK'))->wrap('div', array('class' => 'submit-wrapper'));
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
