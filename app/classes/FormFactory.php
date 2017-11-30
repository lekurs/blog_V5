<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 29/11/2017
 * Time: 00:14
 */

namespace app\classes;


class FormFactory
{
    public static function getForm($name)
    {
        $name = ucfirst($name);
        $class_name = "\\app\\classes\\Form" . $name;
        return new $class_name;
    }


}