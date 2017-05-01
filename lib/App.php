<?php

namespace feedback\lib;

use feedback\lib\Router,
    feedback\lib\View,
    feedback\lib\DB;


/**
 * Обработка запросов приложения, вызов методов контроллера
 *
 * @author Lexa
 */
class App 
{
    protected static $router;
    
    public static $db;


    static function getRouter() 
    {
        return self::$router;
    }
    
    /**
     * Обработка запросов приложения
     * @param String $uri
     */
    public static function run($uri)
    {
        self::$router = new Router($uri);
        
        self::$db = new DB(Config::get('db.host'),Config::get('db.user'),Config::get('db.password'),Config::get('db.db_name'));
        
        $controller_class = 'feedback\\controllers\\'.ucfirst(self::$router->getController()).'Controller';
        $controller_method = strtolower(self::$router->getMethodPrefix().self::$router->getAction());
        
        $layout = self::$router->getRoute();
        if ($layout == 'admin' && Session::get('role') != 'admin') {
            if ($controller_method != 'admin_login') {
                Router::redirect('/admin/users/login');
            }
        }
        if(class_exists($controller_class)) {
            $controller_object = new $controller_class;
        } else {
            Router::errorPage404();
        }
        
        if ( method_exists($controller_object, $controller_method) )
        {
            $view_path = $controller_object->$controller_method();
            $view_object = new View($controller_object->getData(), $view_path);
            $content = $view_object->render();
        } else {
            Router::errorPage404();
        }
        
        
        $layout_path = VIEW_PATH.DS.$layout.'.php';
        $layout_view_object = new View(compact('content'), $layout_path);
        echo $layout_view_object->render();
    }
}
