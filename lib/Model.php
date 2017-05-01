<?php

namespace feedback\lib;

use feedback\lib\App;

/**
 * Базовый класс модели
 *
 * @author Lexa
 */
class Model 
{
    protected $db;
    
    public function __construct() {
        $this->db = App::$db;
    }

}
