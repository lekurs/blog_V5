<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 24/11/2017
 * Time: 15:11
 */

namespace app\lib;
use \PDO;

class QueryBuilder extends Database
{
    private $select = [];
    private $from = [];
    private $where = [];

    public function select($fields, $alias =null)
    {
        if(is_null($alias))
        {
            $this->select[] = $fields;
        }
        $this->select = func_get_args();

        return $this;
    }

    public function from($table, $alias = null)
    {
        if(is_null($alias))
        {
            $this->from[] = $table;
        }
        else
        {
            $this->from[] = $table .' AS ' . $alias;
        }
        return $this;
    }

    public function where()
    {
        foreach (func_get_args() as $args)
        {
            $this->where[] = $args;
        }
        return $this->where;
    }

    public function __toString()
    {
        return
            'SELECT ' .implode(' AS ', $this->select) .
            ' FROM ' . implode(', ', $this->from) .
            ' WHERE ' . implode(' AND  ', $this->where);
    }
}