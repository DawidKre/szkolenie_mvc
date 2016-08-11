<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing;
use Core\Router;

$routes = new Routing\RouteCollection();
$router = new Router(new Routing\RouteCollection());


// Articles Model 

//$router->addPost('new_article', '/article/new', array(
//    '_controller' => 'Api\\Controller\\ArticlesController::newAction'
//));
$router->addMethods('new_article', '/article/new', array(
    '_controller' => 'Api\\Controller\\ArticlesController::newAction'
), [], array(
    'post',
    'get'
));
$router->addMethods('edit_article', '/article/edit/{id}', array(
    '_controller' => 'Api\\Controller\\ArticlesController::editAction'
), [], array(
    'post',
    'get'
));

//$router->addGet('new_form_article', '/article/newForm', array(
//    '_controller' => 'Api\\Controller\\ArticlesController::newAction'
//));
//$router->addGet('edit_form_article', '/article/editForm/{id}', array(
//    '_controller' => 'Api\\Controller\\ArticlesController::editAction'
//));

$router->addGet('articles', '/articles/{page}', array(
    'page' => 1,
    '_controller' => 'Api\\Controller\\ArticlesController::indexAction'
), array(
    'id' => '\d+'
));
$router->addGet('show_article', '/article/{id}', array(
    '_controller' => 'Api\\Controller\\ArticlesController::showAction'
), array(
    'id' => '\d+'
));
$router->addGet('delete_article', '/article/delete/{id}', array(
    '_controller' => 'Api\\Controller\\ArticlesController::deleteAction'
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
$router->addGet('new_category', '/category/new', array(
    '_controller' => 'Api\\Controller\\CategoryController::newAction'
));
$router->addGet('edit_category', '/category/edit/{id}', array(
    '_controller' => 'Api\\Controller\\CategoryController::editAction'
), array(
    'id' => '\d+'
));
$router->addGet('categories', '/categories/{page}', array(
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



$routes->add('new_category', new Routing\Route('/category/new', array(
    '_controller' => 'Api\\Controller\\CategoryController::newAction'
)));

$routes->add('edit_category', new Routing\Route('/category/edit/{id}', array(
    '_controller' => 'Api\\Controller\\CategoryController::editAction'
)));
$routes->add('categories', new Routing\Route('/categories/{page}', array(
    'page' => 1,
    '_controller' => 'Api\\Controller\\CategoryController::indexAction'
), array(
    'id' => '\d+'
)));
$routes->add('show_category', new Routing\Route('/category/{id}', array(
    '_controller' => 'Api\\Controller\\CategoryController::showAction'
), array(
    'id' => '\d+'
)));
$routes->add('delete_category', new Routing\Route('/category/delete/{id}', array(
    '_controller' => 'Api\\Controller\\CategoryController::deleteAction'
)));

return $router->getRouteCollection();
//return $routes;