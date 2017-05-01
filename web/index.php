<?php

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));
define('VIEW_PATH', ROOT.DS.'views');

require_once(ROOT.'/vendor/autoload.php');
require_once(ROOT.DS.'config'.DS.'config.php');


use feedback\lib\App;

$uri = filter_input(INPUT_SERVER, 'REQUEST_URI');

session_start();

App::run($uri);