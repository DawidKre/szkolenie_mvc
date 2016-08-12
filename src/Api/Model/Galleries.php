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
use PDO;

class Galleries extends Model
{
    public function getList()
    {
        $stmt = $this->pdo->query('
            SELECT g.*, a.*, p.*  
            FROM mydb.galleries g 
            LEFT JOIN mydb.articles a ON g.gal_id = a.galleries_gal_id
            LEFT JOIN mydb.photos p ON g.gal_id = p.pht_gal_id');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
//$sql = "SELECT c.*, m.name AS 'type'  FROM cms.car c LEFT JOIN cms.mark m ON c.mark_id = m.id ORDER BY c.id DESC 
//LIMIT " . $from . ', ' . $limit;

    /*public function getArticle($id)
    {
        $stmt = $this->pdo->query("SELECT * FROM article WHERE id = $id");
        return $stmt->fetch();
    }

    public function deleteArticle($id)
    {
        $this->pdo->query("DELETE FROM article WHERE id = $id");
    }

    public function newArticle($title, $catId, $content, $image)
    {
        $sth = $this->pdo->prepare('INSERT INTO article(`title`, `cat_id`, `content`, `image`) 
                               VALUES (:title, :cat_id, :content, :image)');
        $sth->bindParam(':title', $title);
        $sth->bindParam(':cat_id', $catId);
        $sth->bindParam(':content', $content);
        $sth->bindParam(':image', $image);
        $sth->execute();
    }

    public function updateArticle($id, $title, $catId, $content, $image = null)
    {
        $sth = $this->pdo->prepare('UPDATE `article` SET `title`= :title,
                                                  `cat_id`= :cat_id,
                                                  `content`= :content,
                                                  `image`= :image
                                               WHERE id = :id');
        $sth->bindParam(':id', $id);
        $sth->bindParam(':title', $title);
        $sth->bindParam(':cat_id', $catId);
        $sth->bindParam(':content', $content);
        $sth->bindParam(':image', $image);
        $sth->execute();
    }

    public function updateWithoutImageArticle($id, $title, $catId, $content)
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
    }*/


}