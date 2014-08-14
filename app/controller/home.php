<?php

class home extends base_controller {

    public function index() {
        Form::make('', 'POST', array(
            'class' => 'form'
        ));

        Form::input('text', 'username', array(
            'class' => 'textfield', 'autocomplete' => 'off'
        ));

        Form::input('password', 'password', array(
            'class' => 'password'
        ));

        Form::input('submit', 'login_form_submit', array(
            'value' => 'Login'
        ));

        Form::rules(array(
            'username' => array('required', 'min:3', 'max:5', 'alnumus'),
            'password' => array('required', 'max:255')
        ));

        $form = Form::get();
        $form_msg = '';

        if (Form::submitted()) {
            if (!Form::hasErrors()) {
                $form_msg = 'No errors.';
            } else {
                $form_msg = 'Ahm, there were errors.';
                //d(Form::getErrors());
            }
        }

        $data = array(
            'title' => title(),
            'header' => $this->tpl->header(),
            'form_msg' => $form_msg,
            'content' => $this->tpl->content(array('content' => $form)),
            'footer' => $this->tpl->footer()
        );

        View::layout($this->layout, $data);
    }

}
