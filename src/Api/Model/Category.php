<?php
/**
 * Created by PhpStorm.
 * User: dawid
 * Date: 09.08.16
 * Time: 09:23
 */

namespace Api\Model;

use Core\Model;

class Category extends Model
{
    public function getList()
    {
        $stmt = $this->pdo->query('SELECT * FROM category');
        return $stmt->fetchAll();
    }

    public function getCategory($id)
    {
        $stmt = $this->pdo->query("SELECT * FROM category WHERE id = $id");
        return $stmt->fetch();
    }

    public function deleteCategory($id)
    {
        $this->pdo->query("DELETE FROM category WHERE id = $id");
    }

    public function newCategory($name)
    {
        $sth = $this->pdo->prepare('INSERT INTO category(`name`) VALUES (:name)');
        $sth->bindParam(':name', $name);
        $sth->execute();
    }

    public function updateCategory($id, $name)
    {
        $sth = $this->pdo->prepare('UPDATE `category` SET `name`= :name
                                               WHERE id = :id');
        $sth->bindParam(':id', $id);
        $sth->bindParam(':name', $name);
        $sth->execute();
    }

    public function getTotalRecords()
    {
        $count = $this->pdo->query("SELECT COUNT( id ) as total FROM category")->fetch()['total'];
        return $count;
    }

    public function getPaginationList($from, $limit)
    {
        $sql = "SELECT *  FROM category c ORDER BY c.id DESC LIMIT " . $from . ', ' . $limit;
        $result = $this->pdo->query($sql);
        return $result->fetchAll();
    }


}