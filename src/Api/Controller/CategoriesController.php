<?php

namespace Api\Controller;

use Api\Model\Categories;
use Core\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class CategoriesController extends Controller
{
    public function listAction()
    {
        $list = $this->getCategoriesModel()->getList();
        return $this->render('', array(
            'categories' => $list
        ));
    }

    public function showAction($id)
    {
        $article = $this->getCategoriesModel()->getCategory($id);
        return $this->render('', array(
            'category' => $article
        ));
    }

    public function newAction(Request $request)
    {
        $catName = $request->get('cat_name');
        $catSlug = $request->get('cat_slug');
        $catStatus = $request->get('cat_status');

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
        $category = $this->getCategoriesModel()->getCategory($id);

        $catName = $request->request->get('cat_name');
        $catSlug = $request->get('cat_slug');
        $catStatus = $request->get('cat_status');

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
        $Categories = new Categories($this->databaseConnection());
        return $Categories;
    }

}