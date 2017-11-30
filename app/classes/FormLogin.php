<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 29/11/2017
 * Time: 00:15
 */

namespace app\classes;


class FormLogin
{
    private $password;
    private $email;


    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setEmail($email)
    {
        if(is_string($email))
        {
            $this->email = $email;
        }
    }

    public function setPassword($password)
    {
        if(is_string($password))
        {
            $this->password = $password;
        }
    }
}