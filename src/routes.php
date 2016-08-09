<?php

use Symfony\Component\Routing;

$routes = new Routing\RouteCollection();
$routes->add('new_article', new Routing\Route('/articles/new', array(
    '_controller' => 'Api\\Controller\\ArticlesController::newAction'
)));
$routes->add('edit_article', new Routing\Route('/articles/edit/{id}', array(
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


// Category Model

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


return $routes;