<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 24/11/2017
 * Time: 13:54
 */

namespace src\managers;
use app\classes\Database;
use app\classes\Query;
use app\classes\QueryBuilder;
use \PDO;
use src\models\Chapters;


class ChaptersManager extends Database
{
    private $data = [];

    public function getChapters()
    {
        $db = $this->Connect();

        $req = $db->prepare('SELECT id_chapter as idChapter, title, chapter, DATE_FORMAT(create_date, \'%d/%M/%Y\') AS create_date, online FROM chapter where online = 1 ORDER BY id_chapter');
        $req->execute();
        $req->setFetchMode(PDO::FETCH_ASSOC);

       while($result = $req->fetch())
       {
           $chapters = $this->buildChapters($result);

           $this->data[] = $chapters;
       }

       return $this->data;
    }


    public function getChapter($idChapter)
    {
        $db = $this->Connect();
        $req = $db->prepare('SELECT id_chapter AS idChapter, title, chapter, DATE_FORMAT(create_date, \'%d/%M/%Y\') AS create_date, online FROM chapter WHERE id_chapter = :idChapter');
        $req->bindValue(':idChapter', $idChapter, \PDO::PARAM_INT);
        $req->execute();
        $req->setFetchMode(PDO::FETCH_ASSOC);

        return $this->data[] = $this->buildChapters($req->fetch());
    }

    public function chapterOffline()
    {
        $db = $this->Connect();

        $req = $db->prepare('SELECT id_chapter AS idChapter, title, chapter, DATE_FORMAT(create_date, \'%d/%m/%Y\') AS date_create, online FROM chapter WHERE online = 0 ORDER BY id_chapter');
        $req->execute();
        $req->setFetchMode(PDO::FETCH_ASSOC);

        while($results = $req->fetch())
        {
            $chaptersOff = $this->buildChapters($results);

            $this->data[] = $chaptersOff;
        }

        return $this->data;
    }

    public function countChapter()
    {
        $db = $this->Connect();
        $req = $db->prepare('SELECT id_chapter, title, chapter, DATE_FORMAT(create_date, \'%d/%m/%Y\') AS date_creation FROM chapter where online = 1');
        $req->execute();
        return $req->rowCount();

    }

    public function addChapter(Chapters $chapter)
    {
        $db = $this->Connect();
        $req = $db->prepare('INSERT INTO chapter (title, chapter, create_date, online) VALUES (:title, :chapter, NOW(), :online)');
        $req->bindValue(':title', $chapter->title(), PDO::PARAM_STR);
        $req->bindValue(':chapter', $chapter->chapter(), PDO::PARAM_STR);
        $req->bindValue(':online', $chapter->online(), PDO::PARAM_INT);

        $req->execute();

        $req->closeCursor();
    }

    public function delChapter(Chapters $chapters)
    {
        $db = $this->Connect();
        $req = $db->prepare('DELETE FROM chapter WHERE id_chapter = :chapter');
        $req->execute(array(':chapter' => $chapters->idChapter()));

        $req->closeCursor();
    }

    public function updateChapter(Chapters $chapter)
    {
        $db = $this->Connect();
        $req = $db->prepare('UPDATE chapter SET title = :title, chapter = :chapter, create_date =NOW(), online = :online WHERE id_chapter = :chapterId');
        $req->bindValue(':title', $chapter->title(), PDO::PARAM_STR);
        $req->bindValue(':chapter', $chapter->chapter(), PDO::PARAM_STR);
        $req->bindValue(':online', $chapter->online(), PDO::PARAM_INT);
        $req->bindValue('chapterId', $chapter->idChapter(), PDO::PARAM_INT);
        $req->execute();

        $req->closeCursor();
    }

    private function buildChapters(array $data)
    {
        $model = new Chapters();

        $model->setTitle($data['title']);
        $model->setIdChapter($data['idChapter']);
        $model->setCreate_date($data['create_date']);
        $model->setOnline($data['online']);
        $model->setChapter($data['chapter']);

        return $model;
    }
}