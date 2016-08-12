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
        $stmt = $this->pdo->query
        ('
          SELECT u.*  
          FROM mydb.users u
        ');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}