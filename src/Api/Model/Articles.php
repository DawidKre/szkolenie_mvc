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
          SELECT a.*, c.*, com.*
          FROM mydb.articles a
          LEFT JOIN mydb.categories c 
          ON c.cat_id = a.art_cat_id
          LEFT JOIN mydb.galleries g 
          ON g.gal_id = a.galleries_gal_id
          LEFT JOIN mydb.comments com 
          ON com.cmt_art_id = a.art_id
          WHERE art_id = $id"
        );
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function createArticle($artTitle, $artSlug, $artStatus, $artBody, $artDate, $artCatId, $artUsrId, $artGalId)
    {
        $sth = $this->pdo->prepare("
        INSERT INTO mydb.articles(art_title, art_slug, art_status, art_body, art_date, art_cat_id, art_usr_id, galleries_gal_id) 
        VALUES (:artTitle, :artSlug, :artStatus, :artBody, :artDate, :artCatId, :artUsrId, :artGalId)"
        );
        $sth->bindParam(':artTitle', $artTitle);
        $sth->bindParam(':artSlug', $artSlug);
        $sth->bindParam(':artStatus', $artStatus);
        $sth->bindParam(':artBody', $artBody);
        $sth->bindParam(':artDate', $artDate);
        $sth->bindParam(':artCatId', $artCatId);
        $sth->bindParam(':artUsrId', $artUsrId);
        $sth->bindParam(':artGalId', $artGalId);
        return $sth->execute();
    }

    public function updateArticle($artId, $artTitle, $artSlug, $artStatus, $artBody, $artDate, $artCatId, $artUsrId,
                                  $artGalId)
    {
        $sth = $this->pdo->prepare("
            UPDATE mydb.articles
            SET art_title= :artTitle, art_slug= :artSlug, art_status= :artStatus, art_body= :artBody, art_date= 
            :artDate, art_cat_id= :artCatId, art_usr_id= :artUsrId, galleries_gal_id= :artGalId
            WHERE art_id = :artId"
        );
        $sth->bindParam(':artId', $artId);
        $sth->bindParam(':artTitle', $artTitle);
        $sth->bindParam(':artSlug', $artSlug);
        $sth->bindParam(':artStatus', $artStatus);
        $sth->bindParam(':artBody', $artBody);
        $sth->bindParam(':artDate', $artDate);
        $sth->bindParam(':artCatId', $artCatId);
        $sth->bindParam(':artUsrId', $artUsrId);
        $sth->bindParam(':artGalId', $artGalId);
        return $sth->execute();
    }

    public function deleteArticle($id)
    {
        return $this->pdo->query("
            DELETE FROM mydb.articles 
            WHERE art_id = $id"
        )->execute();
    }

    public function createComment($cmtBody, $cmtStatus, $cmtUsrId, $cmtArtId)
    {
        $sth = $this->pdo->prepare("
        INSERT INTO mydb.comments(cmt_body, cmt_status, cmt_usr_id, cmt_art_id) 
        VALUES (:cmtBody, :cmtStatus, :cmtUsrId, :cmtArtId)"
        );
        $sth->bindParam(':cmtBody', $cmtBody);
        $sth->bindParam(':cmtStatus', $cmtStatus);
        $sth->bindParam(':cmtUsrId', $cmtUsrId);
        $sth->bindParam(':cmtArtId', $cmtArtId);

        return $sth->execute();
    }

    public function updateComment($cmtId, $cmtBody, $cmtStatus, $cmtUsrId, $cmtArtId)
    {
        $sth = $this->pdo->prepare("
            UPDATE mydb.comments
            SET cmt_body= :cmtBody, cmt_status= :cmtStatus, cmt_usr_id= :cmtUsrId, cmt_art_id= :cmtArtId
            WHERE cmt_id = :cmtId"
        );
        $sth->bindParam(':cmtId', $cmtId);
        $sth->bindParam(':cmtBody', $cmtBody);
        $sth->bindParam(':cmtStatus', $cmtStatus);
        $sth->bindParam(':cmtUsrId', $cmtUsrId);
        $sth->bindParam(':cmtArtId', $cmtArtId);

        return $sth->execute();
    }

    public function getComment($id)
    {
        $stmt = $this->pdo->query("
          SELECT c.*
          FROM mydb.comments c
          WHERE cmt_id = $id"
        );
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getCommentsList($id)
    {
        $stmt = $this->pdo->query("
          SELECT c.*
          FROM mydb.comments c 
          WHERE cmt_art_id = $id"
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalRecords()
    {
        $count = $this->pdo->query("SELECT COUNT( art_id ) as total FROM articles")->fetch()['total'];
        return $count;
    }

    public function getPaginationList($from, $limit)
    {
        $sql = "SELECT *  FROM articles a ORDER BY a.art_id DESC LIMIT " . $from . ', ' . $limit;
        $result = $this->pdo->query($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteComment($id)
    {
        return $this->pdo->query("
            DELETE FROM mydb.comments 
            WHERE cmt_id = $id"
        )->execute();
    }
}