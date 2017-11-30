<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 28/11/2017
 * Time: 09:33
 */

namespace src\managers;

use app\classes\Database;
use src\models\RankUsers;
use PDO;

class RankUsersManager extends Database
{

    private $data = [];

    public function getRank()
    {
        $db = $this->Connect();
        $req = $db->prepare('SELECT * from role ORDER BY role');
        $req->execute();
        $req->setFetchMode(PDO::FETCH_ASSOC);

        while($result = $req->fetch())
        {
            $rank = $this->buildRankUsers($result);
            $this->data[] = $rank;
        }

        return $this->data;
    }

    private function buildRankUsers(array $data)
    {
        $model = new RankUsers();

        $model->setId($data['id']);
        $model->setRole($data['role']);
    }
}