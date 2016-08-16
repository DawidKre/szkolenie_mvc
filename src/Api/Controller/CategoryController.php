<?php

namespace Api\Controller;

use Api\Model\Category;
use Core\Controller;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends Controller
{
    public $limit = 3;

    public function indexAction(Request $request)
    {
        $pageParameter = $request->get('page');
        $count = $this->getCategoryModel()->getTotalRecords();

        $currentPage = isSet($pageParameter) ? intval($pageParameter - 1) : 0;
        $from = $currentPage * $this->limit;
        $totalPages = ceil($count / $this->limit);

        if ($currentPage > $totalPages) {
            return $this->redirect('http://mvc.pl/categories');
        }
        $categories = $this->getCategoryModel()->getPaginationList($from, $this->limit);
        return $this->render('Api/view/category/index.html.twig', array(
            'categories' => $categories,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages
        ));
    }

    public function newAction(Request $request)
    {
        $name = $request->get('name');

        if ($request->isMethod('POST')) {
            $this->getCategoryModel()->newCategory($name);
            return $this->redirect('http://mvc.pl/categories');
        }

        return $this->render('Api/view/category/new.html.twig', array(
            'req' => $request
        ));
    }

    public function showAction($id)
    {
        $category = $this->getCategoryModel()->getCategory($id);
        return $this->render('Api/view/category/show.html.twig', array(
            'category' => $category
        ));
    }

    public function editAction(Request $request, $id)
    {
        $category = $this->getCategoryModel()->getCategory($id);
        $name = $request->get('name');
        if ($request->isMethod('POST')) {
            $this->getCategoryModel()->updateCategory($id, $name);
            return $this->redirect('http://mvc.pl/categories');
        }

        return $this->render('Api/view/category/new.html.twig', array(
            'category' => $category
        ));
    }

    public function deleteAction($id)
    {
        $this->getCategoryModel()->deleteCategory($id);
        return $this->redirect('http://mvc.pl/categories');
    }

    /**
     * @return Category
     */
    private function getCategoryModel()
    {
        $Category = $this->pdo(Category::class);
        return $Category;
    }


}