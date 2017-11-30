<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 27/11/2017
 * Time: 12:49
 */

namespace app\lib;


class Query
{
    public static function __callStatic($name, $arguments)
    {
        $query = new QueryBuilder();
        return call_user_func_array([$query, $name], $arguments);
    }


}