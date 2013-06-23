<?php

class home {

    public function index() {
        /*
        // Example of Usage
        View::layout('default', ['title' => Config::get('app.title')], function($layout, $data) {
            $data = [
                'title' => Config::get('app.title'),
                'forums' => DB::table('forumkopf')->get('name'),
                'newest_posts' => DB::table(['forumbeitraege', 'forumkopf'])
                    ->where('forumbeitraege.forum', '=', 'forumkopf.id')
                    ->order_by('datum', 'desc')
                    ->limit(20)
                    ->get([
                        'forumbeitraege.id',
                        'forumbeitraege.name',
                        'forumbeitraege.thema',
                        'forumbeitraege.datum',
                        'forumkopf.id as forum_id',
                        'forumkopf.name as forum_name'
                    ])
            ];

            $layout = str_replace('{{header}}', View::render('header', $data, ['sub_dir' => 'misc']), $layout);
            $layout = str_replace('{{newest_posts}}', View::render('newest_posts', $data, ['sub_dir' => 'misc']),$layout);
            echo $layout;
        });
        */
    }

}
