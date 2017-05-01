<?php

namespace feedback\lib;

/**
 * Класс уведомлений
 *
 * @author Lexa
 */
class Alert {
    /**
     * Сообщение
     * @var String 
     */
    protected static $flash_message;
    
    public static function setFlash($message) 
    {
        self::$flash_message = $message;
    }
    /**
     * Проверка установлено ли сообщение
     * @return Boolean
     */
    public static function hasFlash() 
    {
        return !is_null(self::$flash_message);
    }
    /**
     * Вывод сообщения
     */
    public static function flash()
    {
        echo self::$flash_message;
        self::$flash_message = null;
    }
}
