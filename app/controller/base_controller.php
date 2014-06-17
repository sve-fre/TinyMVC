<?php

class base_controller {

    protected $layout = null;
    protected $tpl = null;

    public function __construct() {
        $this->layout = 'default';
        $this->tpl = Model::get('Template');
    }

}
