<?php

class View {

    /**
     * View::render()
     *
     * @param $view string The name of the view, without extension (this is defined in app/config/app.php in key "view_extension")
     * @param $data array (Optional) An associative array. Keys of that array will be provided as variable names and its values as variable values
     * @param $config array (Optional) An associative array. Just some configurations: in which sub directory within app/views/ is the view, should it be buffered (default: yes)
     *
     * @return The buffered view, or the included view (depending on 'buffer' configuration, passes 3rd as arguments)
     */
    public static function render($view, $data = null, $config = null) {
        $data = Plugin::registerHook('view_render', $data);
        $buffer = (isset($config) && array_key_exists('buffer', $config)) ? (($config['buffer'] === true) ? true : false) : true;

        if (isset($config) && array_key_exists('sub_dir', $config)) {
            $view_dir = path('view') . (is_array($config['sub_dir']) ? implode(DS, $config['sub_dir']) : $config['sub_dir']) . DS;
        } else {
            $view_dir = path('view');
        }

        $view = $view_dir . $view . Config::get('app.view_extension');

        if (!File::isReadable($view)) {
            echo 'View <code>' . $view . '</code> is not readable or does not exist';
        } else {
            if ($data !== null && is_array($data)) {
                extract($data);
            }

            if ($buffer === false) {
                include $view;
            } else {
                ob_start();
                include $view;
                $output = ob_get_contents();
                ob_end_clean();

                return $output;
            }
        }
    }


    /**
     * View::layout()
     *
     * @param $layout string The name of the layout, without extension (this is defined in app/config/app.php in key "layout extension")
     * @param $data array (Optional) An associative array. Keys of that array will be provided as variable names and its values as variable values
     * @param $callback function (Optional) An anonymous function that returns the rendered layout (you have to "echo" or "print" it yourself)
     */
    public static function layout($layout, $data = null, $callback = null) {
        if (!$layout) {
            return;
        }

        $data = Plugin::registerHook('layout_render', $data);
        $layout = path('view') . 'layout' . DS . $layout . Config::get('app.layout_extension');

        if (!File::isReadable($layout)) {
            echo 'Layout <code>' . $layout . '</code> is not readable or does not exist';
        } else {
            if ($data !== null && is_array($data)) {
                extract($data);
            }

            ob_start();
                include $layout;
                $output = ob_get_contents();
            ob_end_clean();

            if ($callback && is_callable($callback)) {
                $callback($output, $data);
            } else {
                echo $output;
            }
        }
    }

}
