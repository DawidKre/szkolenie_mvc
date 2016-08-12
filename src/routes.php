<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing;
use Core\Router;

$routes = new Routing\RouteCollection();
$router = new Router(new Routing\RouteCollection());


// Article Model 

$router->addMethods('new_article', '/article/new', array(
    '_controller' => 'Api\\Controller\\ArticleController::newAction'
), array(), array(
    'POST',
    'GET'
));
$router->addMethods('edit_article', '/article/edit/{id}', array(
    '_controller' => 'Api\\Controller\\ArticleController::editAction'
), [], array(
    'POST',
    'GET'
));
$router->addGet('articles', '/articless/{page}', array(
    'page' => 1,
    '_controller' => 'Api\\Controller\\ArticleController::indexAction'
));
$router->addGet('show_article', '/article/{id}', array(
    '_controller' => 'Api\\Controller\\ArticleController::showAction'
), array(
    'id' => '\d+'
));
$router->addGet('delete_article', '/article/delete/{id}', array(
    '_controller' => 'Api\\Controller\\ArticleController::deleteAction'
));

/*

$routes->add('new_article', new Routing\Route('/articles/new', array(
    '_controller' => 'Api\\Controller\\ArticlesController::newAction'
)));

$routes->add('edit_article', new Routing\Route('/article/edit/{id}', array(
    '_controller' => 'Api\\Controller\\ArticlesController::editAction'
)));
$routes->add('articles', new Routing\Route('/articles/{page}', array(
    'page' => 1,
    '_controller' => 'Api\\Controller\\ArticlesController::indexAction'
), array(
    'id' => '\d+'
)));
$routes->add('show_article', new Routing\Route('/article/{id}', array(
    '_controller' => 'Api\\Controller\\ArticlesController::showAction'
), array(
    'id' => '\d+'
)));
$routes->add('delete_article', new Routing\Route('/articles/delete/{id}', array(
    '_controller' => 'Api\\Controller\\ArticlesController::deleteAction'
)));
$routes->add('new_image', new Routing\Route('/image', array(
    '_controller' => 'Api\\Controller\\ArticlesController::imageAction'
)));*/

// Category Model

$router->addMethods('new_category', '/category/new', array(
    '_controller' => 'Api\\Controller\\CategoryController::newAction'
), [], array(
    'POST',
    'GET'
));

$router->addMethods('edit_category', '/category/edit/{id}', array(
    '_controller' => 'Api\\Controller\\CategoryController::editAction'
), [], array(
    'POST',
    'GET'
));
$router->addGet('categories', '/categoriess/{page}', array(
    'page' => 1,
    '_controller' => 'Api\\Controller\\CategoryController::indexAction'
), array(
    'id' => '\d+'
));
$router->addGet('show_category', '/category/{id}', array(
    '_controller' => 'Api\\Controller\\CategoryController::showAction'
), array(
    'id' => '\d+'
));
$router->addGet('delete_category', '/category/delete/{id}', array(
    '_controller' => 'Api\\Controller\\CategoryController::deleteAction'
));


//REST API CONTROLLERS

$router->addGet('list_articles', '/articles/{page}', array(
    'page' => 1,
    '_controller' => 'Api\\Controller\\ArticlesController::listAction'
));

$router->addGet('list_categories', '/categories/{page}', array(
    'page' => 1,
    '_controller' => 'Api\\Controller\\CategoriesController::listAction'
));
$router->addGet('list_galleries', '/galleries/{page}', array(
    'page' => 1,
    '_controller' => 'Api\\Controller\\GalleriesController::listAction'
));
$router->addGet('list_photos', '/photos/{page}', array(
    'page' => 1,
    '_controller' => 'Api\\Controller\\PhotosController::listAction'
));
$router->addGet('list_users', '/users/{page}', array(
    'page' => 1,
    '_controller' => 'Api\\Controller\\UsersController::listAction'
));
return $router->getRouteCollection();
