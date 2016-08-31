<?php

namespace Api\Controller;

use Api\Model\Article;
use Api\Upload\FileUploader;
use Core\Controller;
use Symfony\Component\HttpFoundation\Request;


class ArticleController extends Controller
{
    public function __construct()
    {
        $this->decodeToken();
    }

    public $limit = 6;

    public function indexAction(Request $request)
    {
        $pageParameter = $request->get('page');
        $currentPage = isSet($pageParameter) ? intval($pageParameter - 1) : 0;

        $from = $currentPage * $this->limit;
        $count = $this->getArticleModel()->getTotalRecords();
        $totalPages = ceil($count / $this->limit);

        if ($currentPage > $totalPages) {
            return $this->redirect('http://mvc.pl/blog/articles');
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
        $image = $request->files->get('image');

        $targetDir = __DIR__ . '/../public/img';
        $uploader = new FileUploader($targetDir);

        if ($request->isMethod('POST')) {
            if ($image != null) {
                $fileName = $uploader->upload($image);
            }
            $this->getArticleModel()->newArticle($title, $catId, $content, $fileName);
            return $this->redirect('http://mvc.pl/blog/articles');
        }

        return $this->render('Api/view/article/new.html.twig', array(
            'req' => $request,
            'img' => $image
        ));
    }

    public function showAction($id)
    {
        $article = $this->getArticleModel()->getArticle($id);
        return $this->render('Api/view/article/list.html.twig', array(
            'article' => $article
        ));
    }

    public function editAction(Request $request, $id)
    {
        $article = $this->getArticleModel()->getArticle($id);
        $oldFileName = $article['image'];
        $title = $request->get('title');
        $catId = $request->get('catId');
        $content = $request->get('content');

        $image = $request->files->get('image');
        $targetDir = __DIR__ . '/../public/img';
        $uploader = new FileUploader($targetDir);

        if ($request->isMethod('POST')) {
            if ($image != null) {
                $fileName = $uploader->upload($image);
                $this->getArticleModel()->updateArticle($id, $title, $catId, $content, $fileName);
                if ($oldFileName) {
                    unlink(__DIR__ . '/../public/img/' . $oldFileName);
                    unlink(__DIR__ . '/../public/img/' . str_replace('cover_', '', $oldFileName));
                }
            } else {
                $this->getArticleModel()->updateWithoutImageArticle($id, $title, $catId, $content);
            }

            return $this->redirect('http://mvc.pl/blog/articles');
        }

        return $this->render('Api/view/article/new.html.twig', array(
            'article' => $article
        ));
    }

    public function deleteAction($id)
    {
        $this->getArticleModel()->deleteArticle($id);
        return $this->redirect('http://mvc.pl/blog/articles');
    }

    /**
     * @return Article
     */
    private function getArticleModel()
    {
        $Articles = $this->pdo(Article::class);
        return $Articles;
    }
}