<?php

namespace Core;

use Core\Providers\PDOServiceProvider;
use Core\Providers\TwigServiceProvider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing;

class Controller
{
    private $config;
    private $view;
    private $urlGenerator;
    private $pdo;
    private $format;
    
    public function __construct()
    {
        $this->loadConfig();

        $routes = include __DIR__ . '/../src/routes.php';
        $this->urlGenerator = new UrlGenerator($routes, new Routing\RequestContext());

        $twig = new TwigServiceProvider($this->config['twig']);
        $pdo = new PDOServiceProvider($this->config['database']);
        $this->view = $twig->provide(array(
            'urlGenerator' => $this->urlGenerator,
            'getPathInfo' => Request::createFromGlobals()->getPathInfo()
        ));
        $this->pdo = $pdo->provide(array());
    }

    private function loadConfig()
    {
        $this->config = include(__DIR__ . '/../src/config.php');
    }

    public function render($name, $data = [])
    {
        if ($this->format == 'json') {
            $body = json_encode($data);
        } else {
            $body = $this->view->render($name, $data);
        }

        return new Response($body);
    }
    public function databaseConnection()
    {
        return $this->pdo;
    }

    public function pdo($class)
    {
        return new $class($this->pdo);
    }

    public function redirect($route)
    {
        return header('Location: ' . $route);
    }

    public function setFormat($format)
    {
        $this->format = $format;
    }
}