<?php
/**
 * Created by PhpStorm.
 * User: dawid
 * Date: 09.08.16
 * Time: 09:23
 */

namespace Api\Model;

namespace Api\Model;

use Core\Model;

class Articles extends Model
{
    public function getList()
    {
        $stmt = $this->pdo->query('SELECT * FROM article');
        return $stmt->fetchAll();
    }

    public function getArticle($id)
    {
        $stmt = $this->pdo->query("SELECT * FROM article WHERE id = $id");
        return $stmt->fetch();
    }

    public function deleteArticle($id)
    {
        $this->pdo->query("DELETE FROM article WHERE id = $id");
    }

    public function newArticle($title, $catId, $content)
    {
        $sth = $this->pdo->prepare('INSERT INTO article(`title`, `cat_id`, `content`) 
                               VALUES (:title, :cat_id, :content)');
        $sth->bindParam(':title', $title);
        $sth->bindParam(':cat_id', $catId);
        $sth->bindParam(':content', $content);
        $sth->execute();
    }

    public function updateArticle($id, $title, $catId, $content)
    {
        $sth = $this->pdo->prepare('UPDATE `article` SET `title`= :title,
                                                  `cat_id`= :cat_id,
                                                  `content`= :content
                                               WHERE id = :id');
        $sth->bindParam(':id', $id);
        $sth->bindParam(':title', $title);
        $sth->bindParam(':cat_id', $catId);
        $sth->bindParam(':content', $content);
        $sth->execute();
    }

    public function getTotalRecords()
    {
        $count = $this->pdo->query("SELECT COUNT( id ) as total FROM article")->fetch()['total'];
        return $count;
    }

    public function getPaginationList($from, $limit)
    {
        $sql = "SELECT *  FROM article a ORDER BY a.id DESC LIMIT " . $from . ', ' . $limit;
        $result = $this->pdo->query($sql);
        return $result->fetchAll();
    }


}