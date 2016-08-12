<?php

namespace Api\Controller;


use Api\Model\Articles;
use Core\Controller;
use Symfony\Component\HttpFoundation\Request;

class ArticlesController extends Controller
{
    public function listAction()
    {
        $list = $this->getArticlesModel()->getList();
        return $this->render('', array(
            'articles' => $list
        ));
    }

    public function showAction($id)
    {
        $article = $this->getArticlesModel()->getArticle($id);
        return $this->render('', array(
            'article' => $article
        ));
    }

    public function newAction(Request $request)
    {
        $data = $request->getContent();

        return $this->render('', array(
            'data' => $data
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