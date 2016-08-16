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

class Users extends Model
{
    public function getList()
    {
        $stmt = $this->pdo->query('
          SELECT u.*  
          FROM mydb.users u
        ');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUser($id)
    {
        $stmt = $this->pdo->query("
            SELECT * 
            FROM mydb.users u 
            WHERE u.usr_id = $id"
        );
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getPaginationList($from, $limit)
    {
        $sql = "SELECT u.*  FROM users u ORDER BY u.usr_id DESC LIMIT " . $from . ', ' . $limit;
        $result = $this->pdo->query($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateUser($id, $usrName, $usrPassword, $usrEmail, $usrStatus, $usrRole, $usrDate)
    {
        $sth = $this->pdo->prepare("
            UPDATE mydb.users
            SET usr_name= :usrName, usr_password= :usrPassword, usr_email= :usrEmail, usr_status= :usrStatus,
            usr_role= :usrRole, usr_date= :usrDate
            WHERE usr_id = :usrId"
        );
        $sth->bindParam(':usrId', $id);
        $sth->bindParam(':usrName', $usrName);
        $sth->bindParam(':usrPassword', $usrPassword);
        $sth->bindParam(':usrEmail', $usrEmail);
        $sth->bindParam(':usrStatus', $usrStatus);
        $sth->bindParam(':usrRole', $usrRole);
        $sth->bindParam(':usrDate', $usrDate);

        return $sth->execute();

    }

    public function createUser($usrName, $usrPassword, $usrEmail, $usrStatus, $usrRole, $usrDate)
    {
        $sth = $this->pdo->prepare("
        INSERT INTO mydb.users(usr_name, usr_password, usr_email, usr_status, usr_role, usr_date) 
        VALUES (:usrName, :usrPassword, :usrEmail, :usrStatus, :usrRole, :usrDate)"
        );
        $sth->bindParam(':usrName', $usrName);
        $sth->bindParam(':usrPassword', $usrPassword);
        $sth->bindParam(':usrEmail', $usrEmail);
        $sth->bindParam(':usrStatus', $usrStatus);
        $sth->bindParam(':usrRole', $usrRole);
        $sth->bindParam(':usrDate', $usrDate);

        return $sth->execute();
    }

    public function getTotalRecords()
    {
        $count = $this->pdo->query("SELECT COUNT( usr_id ) as total FROM mydb.users")->fetch()['total'];
        return $count;
    }

    public function deleteUser($id)
    {
        return $this->pdo->query("
            DELETE FROM mydb.users 
            WHERE usr_id = $id"
        )->execute();
    }

    public function getUserArticles($id)
    {
        $stmt = $this->pdo->query("
          SELECT a.*
          FROM mydb.articles a 
          WHERE art_usr_id = $id"
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserComments($id)
    {
        $stmt = $this->pdo->query("
          SELECT c.*
          FROM mydb.comments c
          WHERE cmt_usr_id = $id"
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}