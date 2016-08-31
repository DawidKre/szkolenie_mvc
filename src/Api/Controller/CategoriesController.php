<?php

namespace Api\Controller;

use Api\Model\Categories;
use Core\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class CategoriesController extends Controller
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
        $count = $this->getCategoriesModel()->getTotalRecords();
        $totalPages = ceil($count / $limit);
        $list = $this->getCategoriesModel()->getPaginationList($from, $limit);

        //$list = $this->getCategoriesModel()->getList();
        return $this->render('', array(
            'categories' => $list,
            'limit' => intval($limit),
            'count' => $count,
            'total_pages' => $totalPages

        ));
    }

    public function showAction($id)
    {
        $article = $this->getCategoriesModel()->getCategory($id);
        $articles = $this->getCategoriesModel()->getArticlesList($id);
        return $this->render('', array(
            'category' => $article,
            'articles' => $articles
        ));
    }

    public function newAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $catName = $data['cat_name'];
        $catSlug = $data['cat_slug'];
        $catStatus = $data['cat_status'];

        if (($this->getCategoriesModel()->createCategory($catName, $catSlug, $catStatus))) {
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
        $data = json_decode($request->getContent(), true);

        $category = $this->getCategoriesModel()->getCategory($id);

        $catName = $data['cat_name'];
        $catSlug = $data['cat_slug'];
        $catStatus = $data['cat_status'];

        if ($catName == '') $catName = $category['cat_name'];
        if ($catSlug == '') $catSlug = $category['cat_slug'];
        if ($catStatus == '') $catStatus = $category['cat_status'];

        if (($this->getCategoriesModel()->updateCategory($id, $catName, $catSlug, $catStatus))) {
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
        if (($this->getCategoriesModel()->getCategory($id))) {
            $this->getCategoriesModel()->deleteCategory($id);
            return $this->render('', array(
                'status' => Response::HTTP_OK
            ));
        }
        return $this->render('', array(
            'status' => Response::HTTP_NOT_FOUND
        ));
    }

    /**
     * @return Categories
     */
    public function getCategoriesModel()
    {
        $Categories = $this->pdo(Categories::class);
        return $Categories;
    }

}