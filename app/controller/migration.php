<?php

class migration extends base_controller {

    public function make() {
        if (!DB::instance()->exists('users')) {
            DB::instance()->create('users', array(
                'id INT NOT NULL AUTO_INCREMENT PRIMARY KEY',
                'username VARCHAR (30)',
                'password VARCHAR (255)',
                'email VARCHAR (255)'
            ));

            DB::instance()->query('INSERT INTO users (id, username, password, email) VALUES (null, :username, :password, :email)', array(
                ':username' => 'admin',
                ':password' => md5('password123'),
                ':email' => 'admin@website.com'
            ));

            $content = 'Created table users, inserted admin user.';
        } else {
            $content = 'Users table all ready exists.';
        }

        View::layout('default', array(
            'title' => title('Migration'),
            'header' => $this->tpl->header(),
            'content' => $content,
            'footer' => $this->tpl->footer()
        ));
    }


    public function rollback() {
        DB::instance()->drop('users');

        View::layout('default', array(
            'title' => title('Migration'),
            'header' => $this->tpl->header(),
            'content' => 'Dropped users table.',
            'footer' => $this->tpl->footer()
        ));
    }

}
