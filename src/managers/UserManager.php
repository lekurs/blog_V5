<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 28/11/2017
 * Time: 09:03
 */

namespace src\managers;

use app\classes\Database;
use src\models\User;
use PDO;


class UserManager extends Database
{
    private $data = [];

    public function login($email)
    {
        $db = $this->Connect();

        $req = $db->prepare('SELECT id_user AS idUser, username AS username, password AS password, email AS email, role as role FROM user WHERE email = :email');
        $req->bindValue('email', $email, PDO::PARAM_STR);
        $req->execute();

        if($req->rowCount() != 0)
        {
            $req->setFetchMode(PDO::FETCH_ASSOC);

            while ($result = $req->fetch())
            {
                $user = $this->buildUsers($result);
                $this->data[] = $user;
            }
            return $this->data;
        }
    }

    public function inscription(User $user)
    {
        $db = $this->Connect();
        $req = $db->prepare('INSERT INTO user (username, password, email, role) VALUES (:username, :password, :email, :role)');
        $req->bindValue('username', $user->username(), PDO::PARAM_STR);
        $req->bindValue('password', $user->password(), PDO::PARAM_STR);
        $req->bindValue('email', $user->email(), PDO::PARAM_STR);
        $req->bindValue('role', $user->role(), PDO::PARAM_INT);
        $req->execute();

        $req->closeCursor();
    }


    public function getMaxUsers()
    {
        $db = $this->Connect();
        $req = $db->prepare('SELECT * FROM user');
        $req->execute();

        return $req->rowCount();
    }

    public function getLastUser()
    {
        $db = $this->Connect();
        $req = $db->prepare('SELECT * FROM user ORDER BY id_user DESC LIMIT 0,1');
        $req->execute();
        $req->setFetchMode(PDO::FETCH_ASSOC);

        while($result = $req->fetch())
        {
            $user = $this->buildUsers($result);
            $this->data[] = $user;
        }
        return $this->data;
    }

    public function allUser()
    {
        $db = $this->Connect();
        $req = $db->prepare('SELECT * FROM user ORDER BY role');
        $req->execute();
        $req->setFetchMode(PDO::FETCH_ASSOC);

        while($result = $req->fetch())
        {
            $user = $this->buildUsers($result);

            $this->data[] = $user;
        }

        return $this->data;
    }

    public function getRankUser($idRank)
    {
        $db = $this->Connect();
        $req = $db->prepare('SELECT id_user AS idUser, username, password, email, role FROM user WHERE role = :idRank ORDER BY role');
        $req->bindValue('idRank', $idRank, PDO::PARAM_INT);
        $req->execute();
        $req->setFetchMode(PDO::FETCH_CLASS, 'User');

        while($result = $req->fetch())
        {
            $user = $this->buildUsers($result);
            $this->data[] = $user;
        }
        return $this->data;
    }

    public function upRankUser(User $user)
{
    $db = $this->Connect();
    $req = $db->prepare('UPDATE user SET role = :role WHERE id_user = :idUser');
    $req->bindValue('role', $user->role(), PDO::PARAM_INT);
    $req->bindValue('idUser', $user->idUser(), PDO::PARAM_INT);
    $req->execute();

    $req->closeCursor();
}

    public function delUser(User $user)
{
    $db = $this->Connect();
    $req = $db->prepare('DELETE FROM user WHERE id_user = :idUser');
    $req->bindValue('idUser', $user->idUser(), PDO::PARAM_INT);
    $req->execute();

    $req->closeCursor();
}

    private function buildUsers(array $data)
    {
        $model = new Users();

        $model->setIdUser($data['idUser']);
        $model->setUsername($data['username']);
        $model->setEmail($data['email']);
        $model->setPassword($data['password']);
        $model->setRole($data['role']);

        return $model;
    }
}