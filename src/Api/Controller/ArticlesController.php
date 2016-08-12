<?php

namespace Api\Controller;


use Api\Model\Articles;
use Core\Controller;

class ArticlesController extends Controller
{
    public function listAction()
    {
        $list = $this->getArticlesModel()->getList();
        return $this->render('', array(
            'articles' => $list
        ));
    }
    
    /**
     * @return Articles
     */
    public function getArticlesModel()
    {
        $Model = new Articles($this->databaseConnection());
        return $Model;
    }


}