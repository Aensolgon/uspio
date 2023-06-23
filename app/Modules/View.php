<?php
namespace app\Modules;

class View
{
    public static function display($view, $data = [])
    {
        $view = APP_HOST . '/app/Views/'.$view.'.php';
        extract($data);

        ob_start();
        include $view;
        return ob_get_clean();
    }
}
