<?php

namespace Api\Controller;

use Api\Model\Categories;
use Core\Controller;

class CategoriesController extends Controller
{
    public function listAction()
    {
        $list = $this->getCategoriesModel()->getList();
        return $this->render('', array(
            'categories' => $list
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