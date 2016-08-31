<?php

namespace Api\Controller;


use Api\Model\Articles;
use Core\Controller;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ArticlesController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->decodeToken();
    }

    public function listAction(Request $request)
    {
        $pageParameter = $request->get('page');
        $limit = $request->get('limit');
        if ($limit > 20) $limit = 20;
        $currentPage = isSet($pageParameter) ? intval($pageParameter - 1) : 0;
        $from = $currentPage * $limit;

        $count = $this->getArticlesModel()->getTotalRecords();
        $totalPages = ceil($count / $limit);

        $list = $this->getArticlesModel()->getPaginationList($from, $limit);

        return $this->render('Api/view/articles/list.html.twig', array(
            'articles' => $list,
            'limit' => intval($limit),
            'total_pages' => $totalPages,
            'count' => $count,
        ));
    }

    public function showAction($id)
    {
        $article = $this->getArticlesModel()->getArticleWithoutJoin($id);
        $comments = $this->getArticlesModel()->getCommentsList($id);
        $galId = $article['galleries_gal_id'];
        $photos = $this->getArticlesModel()->getPhotos($galId);

        return $this->render('', array(
            'article' => $article,
            'comments' => $comments,
            'photos' => $photos
        ));
    }

    public function newAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $artTitle = $data['art_title'];
        $artySlug = $data['art_slug'];
        $artStatus = $data['art_status'];
        $artBody = $data['art_body'];
        $artDate = $data['art_date'];
        $artCatId = $data['art_cat_id'];
        $artUsrId = $data['art_usr_id'];
        $artGalId = $data['galleries_gal_id'];


        if (($this->getArticlesModel()
            ->createArticle($artTitle, $artySlug, $artStatus, $artBody, $artDate, $artCatId, $artUsrId, $artGalId))
        ) {
            return $this->render('', array(
                'status' => Response::HTTP_CREATED
            ), 201);
        }

    }

    public function updateAction(Request $request, $id)
    {
        $article = $this->getArticlesModel()->getArticle($id);

        $data = json_decode($request->getContent(), true);

        $artTitle = $data['art_title'];
        $artSlug = $data['art_slug'];
        $artStatus = $data['art_status'];
        $artBody = $data['art_body'];
        $artDate = $data['art_date'];
        $artCatId = $data['art_cat_id'];
        $artUsrId = $data['art_usr_id'];
        $artGalId = $data['galleries_gal_id'];

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

    public function deleteAction($id, Request $request)
    {

        if (($this->getArticlesModel()->getArticle($id)) AND ($this->decodeToken($request))) {
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
        $data = json_decode($request->getContent(), true);
        $cmtBody = $data['cmt_body'];
        $cmtStatus = $data['cmt_status'];
        $cmtUsrId = $data['cmt_usr_id'];
        $cmtArtId = $data['cmt_art_id'];

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

    public function deleteCommentAction($id, Request $request)
    {
        if (($this->getArticlesModel()->getComment($id)) AND ($this->decodeToken($request))) {
            $this->getArticlesModel()->deleteComment($id);
            return $this->render('', array(
                'status' => Response::HTTP_OK
            ));
        }
        return $this->render('', array(
            'status' => Response::HTTP_NOT_FOUND
        ));
    }

    public function articleCommentsAction(Request $request)
    {
        $artId = $request->get('artId');
        $pageParameter = $request->get('page');
        $limit = $request->get('limit');
        if ($limit > 20) $limit = 20;
        $currentPage = isSet($pageParameter) ? intval($pageParameter - 1) : 0;
        $from = $currentPage * $limit;
        $count = $this->getArticlesModel()->getTotalCommentsRecords($artId);
        $totalPages = ceil($count / $limit);

        $list = $this->getArticlesModel()->getPaginationCommentsList($from, $limit, $artId);

        return $this->render('Api/view/articles/list.html.twig', array(
            'comments' => $list,
            'limit' => intval($limit),
            'total_pages' => $totalPages,
            'count' => $count,
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