/*
# TinyMVC
Very tiny PHP 5 MVC tool, with classes like Request, Router, View (with inheritance), clean URLs (optional) and Database. Inspired by the awesome Laravel PHP Framework.


### Requirements
TinyMVC needs a webserver running PHP => 5.3.


### Installation
Just copy all the contents to your webserver.
We assume you've installed TinyMVC to `/var/www/htdocs/TinyMVC/` and your URL is `http://localhost/TinyMVC/`.
After copying all files, set up the app's config file in `app/config/app.php`.
Your `base_url` would be `http://localhost/TinyMVC/` (note the trailing slash) and your `install_dir` would be `TinyMVC` (no slashes and both case-sensitiv).


### Custom configuration
You can add items in the existing array in `app/config/app.php` (you can even use mutiple dimensions), or create a new config file simply returning a new anonymous array. E.g. create `myconfig.php` within `app/config/` directory with the following content:

    <?php
        return [
            'title' => 'My awesome config.',
            'foo' => [
                'bar' => 123
            ]
        ];
    ?>

You have access to your configurations in controllers, models and views via `Config::get('myconfig.title')` and `Config::get('myconfig.foo.bar')`.


### Starting point
If you want to create a controller for the homepage (where usually nothing in the URL determines a specific controller, but you want to load one, though), edit the line containing `'default_controller' => 'home',` and `'default_action' => 'index'` in `app/config/app.php`. The following controller (`app/controller/home.php`) gets loaded, and its method `index()` gets called when you hit `http:://localhost/TinyMVC/` or `http:://localhost/TinyMVC/home` or `http:://localhost/TinyMVC/home/index` (assuming you have `mod_rewrite` enabled by setting it to `true`, otherwise your URLs would look slightly different, with `index.php?` in between your Base URL and you controller, e.g. `http://localhost/TinyMVC/index.php?home/index`). This is how `app/controller/home.php` could look like:

    class home {

        public function index() {
            echo 'Hello World';
        }

    }

You should see "Hello World" in your browser.


### Views & Layouts
tba
*/
