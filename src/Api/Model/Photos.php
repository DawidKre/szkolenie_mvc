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

class Photos extends Model
{
    public function getList()
    {
        $stmt = $this->pdo->query('
            SELECT p.*, g.*  
            FROM mydb.photos p
            LEFT JOIN mydb.galleries g
            ON p.pht_gal_id = g.gal_id'
        );

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPhoto($id)
    {
        $stmt = $this->pdo->query("
            SELECT p.*, g.* 
            FROM mydb.photos p 
            LEFT JOIN mydb.galleries g
            ON p.pht_gal_id = g.gal_id
            WHERE p.pht_id = $id"
        );
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}