<?php

class home extends base_controller {

    public function index() {
        $tpl = Model::get('Template');

        $form = Form::make('/', 'POST', function($form) {
            $form->textfield('name')->wrap('div', array('class' => 'textfield-wrapper'));
        }, array(
            'class' => 'name-form'
        ));

        $data = array(
            'title' => title(),
            'header' => $tpl->header(),
            'content' => $tpl->content(array('content' => $form)),
            'footer' => $tpl->footer()
        );

        View::layout(self::$layout, $data);
    }

}
