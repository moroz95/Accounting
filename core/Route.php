<?php

/**
 * Class Route
 *
 * Class to include core classes
 * to get controller and action names, include them
 * to call controller action with parameter from URI
 * to call 404 page in case of wrong URI
 *
 * @author phrlog <phrlog@gmail.com>
 *
 */


class Route
{
    static function start()
    {
        error_reporting(E_ALL);

        include '../core/Model.php';
        include '../core/Controller.php';

        session_start();
        
        $controller_name = 'Group';
        $action_name = 'Index';

        $routes = explode('/', $_SERVER['REQUEST_URI']);

        if ( !empty($routes[1]) )
        {
            $controller_name = ucfirst($routes[1]);
        }

        if ( !empty($routes[2]) )
        {
            $action_name = ucfirst($routes[2]);
        }

        if( !empty($routes[3]) )
        {
            $parameter = $routes[3];
        }

        $model_name = $controller_name.'Model';
        $controller_name = $controller_name.'Controller';
        $action_name = 'action'.$action_name;

        $model_file = $model_name.'.php';
        $model_path = "../models/".$model_file;

        if(file_exists($model_path))
        {
            include "$model_path";
        }

        $controller_file = $controller_name.'.php';
        $controller_path = "../controllers/".$controller_file;

        if(file_exists($controller_path))
        {
            include "$controller_path";
        }
        else
        {
            Route::ErrorPage404();
        }

        $controller = new $controller_name($model_name);
        $action = $action_name;

        if(method_exists($controller, $action))
        {
            $controller->$action($parameter);
        }
        else
        {
            Route::ErrorPage404();
        }

    }
    function ErrorPage404()
    {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.$host.'404');
    }

}