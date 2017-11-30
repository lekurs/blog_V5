<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 29/11/2017
 * Time: 00:22
 */

namespace app\classes;


class FormSuscribe
{
    private $password;
    private $email;
    private $login;

    public function __construct(array $datas)
    {
        $this->hydrate($datas);
    }

    public function hydrate(array $datas)
    {
        foreach ($datas as $key => $data)
        {
            $method = 'set'.ucfirst($key);

            if(method_exists($this, $method))
            {
                $this->$method($data);
            }
        }
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getLogin()
    {
        return $this->login;
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

    public function setLogin($login)
    {
        if(is_string($login))
        {
            $this->login = $login;
        }
    }
}