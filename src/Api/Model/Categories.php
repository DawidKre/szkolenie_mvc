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

class Categories extends Model
{
    public function getList()
    {
        $stmt = $this->pdo->query("
          SELECT c.*, a.*
          FROM mydb.categories c 
          LEFT JOIN mydb.articles a 
          ON c.cat_id = a.art_cat_id
          GROUP BY c.cat_id"
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCategory($id)
    {
        $stmt = $this->pdo->query("
          SELECT c.*, a.*
          FROM mydb.categories c 
          LEFT JOIN mydb.articles a 
          ON c.cat_id = a.art_cat_id
          WHERE c.cat_id = $id"
        );
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createCategory($catName, $catSlug, $catStatus)
    {
        $sth = $this->pdo->prepare("
            INSERT INTO mydb.categories(cat_name, cat_slug, cat_status) 
            VALUES (:catName, :catSlug, :catStatus)"
        );
        $sth->bindParam(':catName', $catName);
        $sth->bindParam(':catSlug', $catSlug);
        $sth->bindParam(':catStatus', $catStatus);
        return $sth->execute();
    }

    public function updateCategory($id, $catName, $catSlug, $catStatus)
    {
        $sth = $this->pdo->prepare('
            UPDATE mydb.categories
            SET cat_name= :catName, cat_slug= :catSlug, cat_status= :catStatus
            WHERE cat_id = :catId'
        );
        $sth->bindParam(':catId', $id);
        $sth->bindParam(':catName', $catName);
        $sth->bindParam(':catSlug', $catSlug);
        $sth->bindParam(':catStatus', $catStatus);
        return $sth->execute();
    }

    public function deleteCategory($id)
    {
        return $this->pdo->query("
            DELETE FROM mydb.categories 
            WHERE cat_id = $id"
        )->execute();
    }

    public function getPaginationList($from, $limit)
    {
        $sql = "SELECT *  FROM categories c ORDER BY c.cat_id DESC LIMIT " . $from . ', ' . $limit;
        $result = $this->pdo->query($sql);
        return $result->fetchAll();
    }

}