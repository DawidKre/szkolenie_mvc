<?php

namespace Api\Controller;

use Api\Model\Articles;
use Core\Controller;
use Symfony\Component\HttpFoundation\Request;


class ArticlesController extends Controller
{

    public $limit = 6;

    public function indexAction(Request $request)
    {
        $pageParameter = $request->get('page');
        $currentPage = isSet($pageParameter) ? intval($pageParameter - 1) : 0;

        $from = $currentPage * $this->limit;
        $count = $this->getArticleModel()->getTotalRecords();
        $totalPages = ceil($count / $this->limit);

        if ($currentPage > $totalPages) {
            return $this->redirect('http://mvc.pl/articles');
        }

        $articles = $this->getArticleModel()->getPaginationList($from, $this->limit);
        return $this->render('Api/view/article/index.html.twig', array(
            'articles' => $articles,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages
        ));
    }

    public function newAction(Request $request)
    {
        $title = $request->get('title');
        $catId = $request->get('catId');
        $content = $request->get('content');

        if (($title != null) or ($catId != null) OR ($content != null)) {
            $this->getArticleModel()->newArticle($title, $catId, $content);
            return $this->redirect('http://mvc.pl/articles');
        }

        return $this->render('Api/view/article/new.html.twig', array(
            'req' => $request
        ));
    }

    public function showAction($id)
    {
        $article = $this->getArticleModel()->getArticle($id);
        return $this->render('Api/view/article/show.html.twig', array(
            'article' => $article
        ));
    }

    public function editAction(Request $request, $id)
    {
        $article = $this->getArticleModel()->getArticle($id);

        $title = $request->get('title');
        $catId = $request->get('catId');
        $content = $request->get('content');

        if (($title != null) or ($catId != null) OR ($content != null)) {
            $this->getArticleModel()->updateArticle($id, $title, $catId, $content);
            return $this->redirect('http://mvc.pl/articles');
        }

        return $this->render('Api/view/article/new.html.twig', array(
            'article' => $article
        ));
    }

    public function deleteAction($id)
    {
        $this->getArticleModel()->deleteArticle($id);
        return $this->redirect('http://mvc.pl/articles');
    }

    /**
     * @return Articles
     */
    private function getArticleModel()
    {
        $Articles = new Articles($this->databaseConnection());
        return $Articles;
    }


}