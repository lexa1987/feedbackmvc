<?php

namespace feedback\lib;

use feedback\lib\App;

/**
 * Базовый класс контроллер
 *
 * @author Lexa
 */
class Controller 
{
    protected $data;
    protected $model;
    protected $params;
    
    function __construct($data = []) {
        $this->data = $data;
        $this->params = App::getRouter()->getParams();
    }

    
    function getData() 
    {
        return $this->data;
    }

    function getModel() 
    {
        return $this->model;
    }

    function getParams() 
    {
        return $this->params;
    }


}
