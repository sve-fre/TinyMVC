# tinymvc
Very tiny PHP 5 MVC tool, with classes like Request, Router, View (with inheritance), clean URLs (optional)

## Installation
Just copy all the contents to your webserver. Like `/var/www/htdocs/tinymvc/`.

## Requirements
Tinymvc needs a webserver running PHP => 5.3.

## Workflow
After installation set up the apps config file in `app/config/app.php`. You can add items in the existing array there (you can even use mutiple dimensions), or create a new config file simply returning a new anonymous array. Create `myconfig.php` within `app/config/` directory with the following content:

    <?php
        return array(
            'title' => 'My awesome config.'
        );
    ?>

You would have access to your configurations in controllers, models and views via `Config::myconfig.title`. Assuming your installation base is `http://localhost/tinymvc/` and you would like to create a controller for the start page (where usually nothings in URL determining a controller, but you wanna load one, though), edit the line containing `'default_controller' => 'test_controller',` and `'default_action' => 'test_action'` in `app/config/app.php`. The following controller (`app/controller/test_controller.php`) gets called when there is no controller or when you hit `http:://localhost/tinymvc/test_controller` (assuming you enabled `mod_rewrite` in apps config file, otherwise it would be `http://localhost/tinymvc/index.php?test_controller`).

    class test_controller {

        public function test_action() {
            $data = [
                'msg' => 'huhu',
                'args' => implode(',', Request::segments()),
                'box' => View::render('box', null, ['sub_dir' => 'misc', 'buffer' => true])
            ];

            View::render('index', $data, ['sub_dir' => 'home']);
        }

    }
