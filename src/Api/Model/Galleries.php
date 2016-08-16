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
            LEFT JOIN mydb.articles a 
            ON g.gal_id = a.galleries_gal_id
            LEFT JOIN mydb.photos p 
            ON g.gal_id = p.pht_gal_id'
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getGallery($id)
    {
        $stmt = $this->pdo->query("
            SELECT g.*, a.*, p.* 
            FROM mydb.galleries g
            LEFT JOIN mydb.articles a 
            ON g.gal_id = a.galleries_gal_id
            LEFT JOIN mydb.photos p 
            ON g.gal_id = p.pht_gal_id
            WHERE gal_id = $id"
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createGallery($galName)
    {
        $sth = $this->pdo->prepare("
        INSERT INTO mydb.galleries(gal_name) 
        VALUES (:galName)"
        );
        $sth->bindParam(':galName', $galName);

        return $sth->execute();
    }

    public function updateGallery($galId, $galName)
    {
        {
            $sth = $this->pdo->prepare("
            UPDATE mydb.galleries
            SET gal_name= :galName
            WHERE gal_id = :galId"
            );
            $sth->bindParam(':galId', $galId);
            $sth->bindParam(':galName', $galName);
            return $sth->execute();
        }
    }

    public function deleteGallery($id)
    {
        return $this->pdo->query("
            DELETE FROM mydb.galleries 
            WHERE gal_id = $id"
        )->execute();
    }

    public function getPhotosList($id)
    {
        $stmt = $this->pdo->query("
          SELECT p.*
          FROM mydb.photos p 
          WHERE pht_gal_id = $id"
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}