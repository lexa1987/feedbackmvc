<?php

namespace feedback\lib;

use feedback\lib\Config;

/**
 * Диспетчер запросов (Роутер)
 *
 * @author Lexa
 */
class Router 
{
    protected $uri;
    
    protected $controller;
    
    protected $action;
    
    protected $params;
    
    protected $route;
    
    protected $method_prefix;
    
    function __construct($uri) 
    {
        $this->uri = urldecode(trim($uri, '/'));
        
        $routes = Config::get('routes');
        $this->route = Config::get('default_route');
        $this->method_prefix = isset($routes[$this->route]) ? $routes[$this->route] : '';
        $this->controller = Config::get('default_controller');
        $this->action = Config::get('default_action');
        
        $uri_parts = explode('?', $this->uri);
        
        $path = $uri_parts[0];
        
        $path_parts = explode('/', $path);
        
        
        if ( count($path_parts) ) {
            if( in_array(strtolower(current($path_parts)), array_keys($routes)) ) {
                $this->route = strtolower(current($path_parts));
                $this->method_prefix = isset($routes[$this->route]) ? $routes[$this->route] : '';
                array_shift($path_parts);
            }
            
            if( current($path_parts) ) {
                $this->controller = strtolower(current($path_parts));
                array_shift($path_parts);
            }
            
            if( current($path_parts) ) {
                $this->action = strtolower(current($path_parts));
                array_shift($path_parts);
            }
            
            $this->params = $path_parts;
        }
    }

    public function getUri() 
    {
        return $this->uri;
    }

    public function getController() 
    {
        return $this->controller;
    }

    public function getAction() 
    {
        return $this->action;
    }
    
    public function getParams() 
    {
        return $this->params;
    }

    public function getRoute() 
    {
        return $this->route;
    }

    public function getMethodPrefix() 
    {
        return $this->method_prefix;
    }

    public static function redirect($location)
    {
        header("Location: $location");
    }
    
    public static function errorPage404()
    {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
	header("Status: 404 Not Found");
	header('Location:'.$host.'404.html');
    }
}
