<?php

namespace Api\Controller;


use Api\Model\Articles;
use Core\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ArticlesController extends Controller
{
    public $limit = 3;

    public function listAction(Request $request)
    {
        $pageParameter = $request->get('page');
        $currentPage = isSet($pageParameter) ? intval($pageParameter - 1) : 0;
        $from = $currentPage * $this->limit;

        $list = $this->getArticlesModel()->getPaginationList($from, $this->limit);

        return $this->render('', array(
            'articles' => $list
        ));
    }

    public function showAction($id)
    {
        $article = $this->getArticlesModel()->getArticle($id);
        $comments = $this->getArticlesModel()->getCommentsList($id);
        return $this->render('', array(
            'article' => $article,
            'comments' => $comments
        ));
    }

    public function newAction(Request $request)
    {
        $artTitle = $request->request->get('art_title');
        $artySlug = $request->get('art_slug');
        $artStatus = $request->get('art_status');
        $artBody = $request->get('art_body');
        $artDate = $request->get('art_date');
        $artCatId = $request->get('art_cat_id');
        $artUsrId = $request->get('art_usr_id');
        $artGalId = $request->get('galleries_gal_id');

        if (($this->getArticlesModel()
            ->createArticle($artTitle, $artySlug, $artStatus, $artBody, $artDate, $artCatId, $artUsrId, $artGalId))
        ) {
            return $this->render('', array(
                'status' => Response::HTTP_CREATED
            ), 201);
        }
        return $this->render('', array(
            'status' => 404
        ));
    }

    public function updateAction(Request $request, $id)
    {
        $article = $this->getArticlesModel()->getArticle($id);

        $artTitle = $request->request->get('art_title');
        $artSlug = $request->request->get('art_slug');
        $artStatus = $request->request->get('art_status');
        $artBody = $request->request->get('art_body');
        $artDate = $request->request->get('art_date');
        $artCatId = $request->request->get('art_cat_id');
        $artUsrId = $request->request->get('art_usr_id');
        $artGalId = $request->request->get('galleries_gal_id');

        if ($artTitle == '') $artTitle = $article['art_title'];
        if ($artSlug == '') $artSlug = $article['art_slug'];
        if ($artStatus == '') $artStatus = $article['art_status'];
        if ($artBody == '') $artBody = $article['art_body'];
        if ($artDate == '') $artDate = $article['art_date'];
        if ($artCatId == '') $artCatId = $article['art_cat_id'];
        if ($artUsrId == '') $artUsrId = $article['art_usr_id'];
        if ($artGalId == '') $artGalId = $article['galleries_gal_id'];

        if (($this->getArticlesModel()->updateArticle($id, $artTitle, $artSlug,
            $artStatus, $artBody, $artDate, $artCatId, $artUsrId, $artGalId))
        ) {
            return $this->render('', array(
                'status' => Response::HTTP_OK
            ));
        }
        return $this->render('', array(
            'status' => 404
        ));
    }

    public function deleteAction($id)
    {
        if (($this->getArticlesModel()->getArticle($id))) {
            $this->getArticlesModel()->deleteArticle($id);
            return $this->render('', array(
                'status' => Response::HTTP_OK
            ));
        }
        return $this->render('', array(
            'status' => Response::HTTP_NOT_FOUND
        ));
    }

    public function newCommentAction(Request $request)
    {
        $cmtBody = $request->get('cmt_body');
        $cmtStatus = $request->get('cmt_status');
        $cmtUsrId = $request->get('cmt_usr_id');
        $cmtArtId = $request->get('cmt_art_id');

        if (($this->getArticlesModel()
            ->createComment($cmtBody, $cmtStatus, $cmtUsrId, $cmtArtId))
        ) {
            return $this->render('', array(
                'status' => Response::HTTP_CREATED
            ), 201);
        }
        return $this->render('', array(
            'status' => 404
        ));

    }

    public function updateCommentAction(Request $request, $id)
    {
        $comment = $this->getArticlesModel()->getComment($id);

        $cmtBody = $request->request->get('cmt_body');
        $cmtStatus = $request->request->get('cmt_status');
        $cmtUsrId = $request->request->get('cmt_usr_id');
        $cmtArtId = $request->request->get('cmt_art_id');

        if ($cmtBody == '') $cmtBody = $comment['cmt_body'];
        if ($cmtStatus == '') $cmtStatus = $comment['cmt_status'];
        if ($cmtUsrId == '') $cmtUsrId = $comment['cmt_usr_id'];
        if ($cmtArtId == '') $cmtArtId = $comment['cmt_art_id'];


        if (($this->getArticlesModel()->updateComment($id, $cmtBody, $cmtStatus,
            $cmtUsrId, $cmtArtId))
        ) {
            return $this->render('', array(
                'status' => Response::HTTP_OK
            ));
        }
        return $this->render('', array(
            'status' => 404
        ));
    }

    public function deleteCommentAction($id)
    {
        if (($this->getArticlesModel()->getComment($id))) {
            $this->getArticlesModel()->deleteComment($id);
            return $this->render('', array(
                'status' => Response::HTTP_OK
            ));
        }
        return $this->render('', array(
            'status' => Response::HTTP_NOT_FOUND
        ));
    }
    
    /**
     * @return Articles
     */
    public function getArticlesModel()
    {
        $Model = $this->pdo(Articles::class);
        return $Model;
    }


}