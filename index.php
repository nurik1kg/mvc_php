<?php

//FRONT CONTROLLER


// 1. Обшая настройки
ini_set('Display error',1);
error_reporting(E_ALL);

// 2. Подключение файлов системы

define('ROOT',dirname(__FILE__));
require_once(ROOT. '/component/Router.php');
require_once(ROOT. '/component/Db.php');

// 3. Устаовка соединение с БД


// 4. Вызов Router
$router = new Router();
$router->run();


