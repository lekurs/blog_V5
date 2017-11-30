<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 27/11/2017
 * Time: 09:57
 */

namespace src\managers;
use app\classes\Database;
use \PDO;
use src\models\Comments;


class CommentsManager extends Database
{
    private $data = [];

    public function getComments($idChapter)
    {
        $db = $this->Connect();
        $req = $db->prepare('SELECT c.id_comments AS idComments, c.comments AS comments, c.report AS report, c.user_id AS userId, c.chapter_id AS chapterId, u.username AS username FROM comments AS c INNER JOIN  user AS u ON c.user_id = u.id_user WHERE c.chapter_id = :idChapter');
        $req->bindValue(':idChapter', $idChapter, PDO::PARAM_INT);
        $req->execute();
        $req->setFetchMode(PDO::FETCH_ASSOC);

        while ($result = $req->fetch())
        {
            $comment = $this->commentsBuilder($result);

            $this->data[] = $comment;
        }

        return $this->data;
    }

    private function commentsBuilder(array $data)
    {
        $model = new Comments();

        $model->setIdComments($data['idComments']);
        $model->setComments($data['comments']);
        $model->setReport($data['report']);
        $model->setChapterId($data['chapterId']);
        $model->setUserId($data['userId']);
        $model->setUsername($data['username']);
    }
}