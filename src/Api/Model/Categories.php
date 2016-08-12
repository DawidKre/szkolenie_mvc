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
        $stmt = $this->pdo->query('
          SELECT c.*, a.* 
          FROM mydb.categories c 
          LEFT JOIN mydb.articles a 
          ON c.cat_id = a.art_cat_id');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}