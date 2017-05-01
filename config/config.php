<?php

use feedback\lib\Config;
//Название сайта
Config::set('site name', 'Feedback form');
//Роуты
Config::set('routes', [
    'default' => '',
    'admin' => 'admin_'
]);
//Конфигурация по умолчанию
Config::set('default_route', 'default');
Config::set('default_controller', 'contacts');
Config::set('default_action', 'index');

//Конфигурация базы данных
Config::set('db.host', 'localhost');
Config::set('db.user', 'root');
Config::set('db.password', '');
Config::set('db.db_name', '');

//Произвольная строка
Config::set('salt', '');

//Разрешенные типы изображений
Config::set('type image', ['image/png','image/gif','image/jpeg']);