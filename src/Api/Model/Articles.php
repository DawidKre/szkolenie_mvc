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
          SELECT a.*, c.*, g.*  
          FROM mydb.articles a 
          LEFT JOIN mydb.categories c 
          ON c.cat_id = a.art_cat_id
          LEFT JOIN mydb.galleries g 
          ON g.gal_id = a.galleries_gal_id'
        );

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getArticle($id)
    {
        $stmt = $this->pdo->query("
          SELECT a.*, c.*, g.*
          FROM mydb.articles a
          LEFT JOIN mydb.categories c 
          ON c.cat_id = a.art_cat_id
          LEFT JOIN mydb.galleries g 
          ON g.gal_id = a.galleries_gal_id
          WHERE art_id = $id"
        );
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}