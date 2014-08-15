<?php

class dashboard extends base_controller {

    public function index() {
        if (Session::get('user_data') !== null) {
            $data = array(
                'title' => title('Dashboard'),
                'header' => $this->tpl->header(),
                'content' => $this->tpl->content(array('content' => 'This is the dashboard.')),
                'footer' => $this->tpl->footer()
            );

            View::layout($this->layout, $data);
        } else {
            header('location:' . url('error_404'));
        }
    }


    public function logout() {
        if (Session::get('user_data') !== null) {
            Session::delete('user_data');

            header('location: ' . url());
        }
    }

}
