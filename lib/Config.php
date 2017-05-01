<?php

namespace feedback\lib;

/**
 * Класс для конфигурирования приложения
 *
 * @author Lexa
 */
class Config 
{
    protected static $settings = [];
    /**
     * Получить параметр конфигурации
     * @param type $key
     * @return type
     */
    public static function get($key) 
    {
        return isset(self::$settings[$key]) ? self::$settings[$key] : null;
    }
    /**
     * Устанавить параметр конфигурации
     * @param type $key ключ
     * @param type $value значение
     */
    public static function set($key, $value)
    {
        self::$settings[$key] = $value;
    }
}
