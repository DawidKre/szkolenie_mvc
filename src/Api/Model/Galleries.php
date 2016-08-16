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

    public function getPaginationList($from, $limit)
    {
        $stmt = $this->pdo->query("
            SELECT g.*  
            FROM mydb.galleries g
            LIMIT $from, $limit"
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
        return $stmt->fetch(PDO::FETCH_ASSOC);
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

        $sth = $this->pdo->prepare("
        UPDATE mydb.galleries
        SET gal_name= :galName
        WHERE gal_id = :galId"
        );
        $sth->bindParam(':galId', $galId);
        $sth->bindParam(':galName', $galName);
        return $sth->execute();
        
    }

    public function deleteGallery($id)
    {
        return $this->pdo->query("
            DELETE FROM mydb.galleries 
            WHERE gal_id = $id")->execute();
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

    public function createPhoto($phtSrc, $phtStorage, $phtMain, $phtGalId)
    {
        $sth = $this->pdo->prepare("
        INSERT INTO mydb.photos(pht_src, pht_storage, pht_main, pht_gal_id) 
        VALUES (:phtSrc, :phtStorage, :phtMain, :phtGalId)"
        );
        $sth->bindParam(':phtSrc', $phtSrc);
        $sth->bindParam(':phtStorage', $phtStorage);
        $sth->bindParam(':phtMain', $phtMain);
        $sth->bindParam(':phtGalId', $phtGalId);

        return $sth->execute();
    }

    public function updatePhoto($id, $phtSrc, $phtStorage, $phtMain, $phtGalId)
    {
        $sth = $this->pdo->prepare("
            UPDATE mydb.photos
            SET pht_src= :phtSrc, pht_storage= :phtStorage, pht_main= :phtMain, pht_gal_id= :phtGalId
            WHERE pht_id = :id"
        );
        $sth->bindParam(':id', $id);
        $sth->bindParam(':phtSrc', $phtSrc);
        $sth->bindParam(':phtStorage', $phtStorage);
        $sth->bindParam(':phtMain', $phtMain);
        $sth->bindParam(':phtGalId', $phtGalId);

        return $sth->execute();
    }

    public function getPhoto($id)
    {
        $stmt = $this->pdo->query("
          SELECT p.*
          FROM mydb.photos p
          WHERE pht_id = $id"
        );
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deletePhoto($id)
    {
        return $this->pdo->query("
            DELETE FROM mydb.photos 
            WHERE pht_id = $id"
        )->execute();
    }

    public function getTotalRecords()
    {
        $count = $this->pdo->query("SELECT COUNT( gal_id ) as total FROM mydb.galleries")->fetch()['total'];
        return $count;
    }

    public function getArticlesList($id)
    {
        $stmt = $this->pdo->query("
          SELECT a.*
          FROM mydb.articles a 
          WHERE galleries_gal_id = $id"
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}