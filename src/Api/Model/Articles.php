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

class Articles extends Model
{
    public function getList()
    {
        $stmt = $this->pdo->query('
          SELECT a.*, c.*  
          FROM mydb.articles a 
          LEFT JOIN mydb.categories c 
          ON c.cat_id = a.art_cat_id');

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}