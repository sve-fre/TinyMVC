<?php

class migration extends base_controller {

    public function make() {
        if (!DB::instance()->exists('users')) {
            DB::instance()->create('users', array(
                sql('id'),
                sql('varchar', 'username', 30),
                sql('varchar', 'password'),
                sql('varchar', 'email'),
                sql('datetime', 'created_at'),
                sql('timestamp', 'updated_at')
            ));

            DB::instance()->query('INSERT INTO users (id, username, password, email, created_at) VALUES (null, :username, :password, :email, :created_at)', array(
                ':username' => 'admin',
                ':password' => md5('password123'),
                ':email' => 'admin@website.com',
                ':created_at' => date('Y-m-d H:i:s')
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
