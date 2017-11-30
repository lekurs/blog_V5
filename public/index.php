<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 24/11/2017
 * Time: 11:37
 */
require '../vendor/autoload.php';
$test = new \src\managers\ChaptersManager();
var_dump($test->getChapters());



$testForm = \app\classes\FormFactory::getForm('Login');

$testForm->setEmail('test');
var_dump($testForm);
