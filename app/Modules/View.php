<?php
namespace app\Modules;

class View
{
    public static function display($view, $data = [])
    {
        $view = $_SERVER['DOCUMENT_ROOT'] . '/app/Views/'.$view.'.php';
        extract($data);

        ob_start();
        include $view;
        return ob_get_clean();
    }
}
