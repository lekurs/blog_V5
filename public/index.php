<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 24/11/2017
 * Time: 11:37
 */
require '../vendor/autoload.php';

define ('ROOT', dirname(__DIR__));

//$router = new \app\classes\Router();
//
////$router->getUri('/src/controllers/index');
//var_dump($router->handleRequest($_SERVER['REQUEST_URI']));
//
//$router->handleRequest($_SERVER['REQUEST_URI']);

$test = new \src\controllers\ChaptersController();

$test->index();