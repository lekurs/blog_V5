<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 28/11/2017
 * Time: 09:22
 */

namespace src\managers;

use app\classes\Database;

use src\models\Menus;
use PDO;

class MenusManager extends Database
{
    private $data = [];

    public function getMenus()
    {
        $db = $this->Connect();

        $req = $db->prepare('SELECT * FROM menus');
        $req->execute();
        $req->setFetchMode(PDO::FETCH_CLASS, 'Menus');

        while($result = $req->fetch())
        {
            $menu  = $this->buildMenus($result);

            $this->data[] = $menu;
        }

        return $this->data;
    }

    private function buildMenus(array $data)
    {
        $model = new Menus();

        $model->setIdMenus($data['id_menus']);
        $model->setLien($data['lien']);
        $model->setMenus($data['menus']);
        return $model;
    }}