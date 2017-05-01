<?php

namespace feedback\lib;

use feedback\lib\App;

/**
 * Базовый класс видов
 *
 * @author Lexa
 */
class View 
{
    protected $data;
    
    protected $path;
    /**
     * Возращает путь к шаблону
     * 
     * @return String Путь к шаблону
     */
    protected static function getDefaultViewPath()
    {
        $router = App::getRouter();
        
        if( !$router ) {
            return FALSE;
        }
        
        $controller_dir = $router->getController();
        $template_name = $router->getMethodPrefix() . $router->getAction() . '.php';
        
        return VIEW_PATH.DS.$controller_dir.DS.$template_name;
        
    }
            
    public function __construct($data = [], $path = null) {
        if ( !$path ) {
            $path = self::getDefaultViewPath();
        }
        
        if ( !file_exists($path) ) {
            throw new \Exception('Шаблон не найден по пути: '.$path);
        }
        
        $this->path = $path;
        $this->data = $data;
    }
    
    
    public function render() 
    {
        $data = $this->data;
        
        ob_start();
        include($this->path);
        $content = ob_get_clean();
        
        return $content;
    }
}
