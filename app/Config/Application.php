<?php

namespace app\Config;

class Application
{

    public static function run()
    {
        $target = self::getPath();
        if (!empty($target)) {
            $controller = $target['controller'];
            $method = $target['method'];
            $params = $target['params'];
            spl_autoload_register(function ($class) {
                include str_replace('\\', '/', $class) . '.php';
            });

            if (class_exists('\app\Controllers\\' . $controller . 'Controller')) {
                if (method_exists('app\Controllers\\' . $controller . 'Controller', $method)) {
                    echo call_user_func(array('app\Controllers\\' . $controller . 'Controller', $method), $params);
                } else {
                    echo 'Page Not Found 404 : Method Not Found in Controller ' . $controller;
                }
            } else {
                echo 'Page Not Found 404 : Controller Not Found';
            }
        } else {
            echo call_user_func('app\Controllers\AddressController', 'index');
        }
    }

    private static function getPath()
    {
        $path = explode('/', $_SERVER['PATH_INFO']);
        $params = [];
        if (count($path) > 3) {
            for ($n = 3; $n < count($path); $n++) {
                array_push($params, $path[$n]);
            }
        }

        return [
            'controller' => empty($path[1]) ? 'Address' : ucfirst($path[1]),
            'method' => empty($path[2]) ? 'index' : $path[2],
            'params' => $params
        ];
    }
}
