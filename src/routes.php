<?php

use Symfony\Component\Routing;
use Core\Router;

$routes = new Routing\RouteCollection();
$router = new Router(new Routing\RouteCollection());


// Article Model 

$router->addMethods('new_article', '/blog/article/new', array(
    '_controller' => 'Api\\Controller\\ArticleController::newAction'
), array(), array(
    'POST',
    'GET'
));
$router->addMethods('edit_article', '/blog/article/edit/{id}', array(
    '_controller' => 'Api\\Controller\\ArticleController::editAction'
), [], array(
    'POST',
    'GET'
));
$router->addGet('articles', '/blog/articles/{page}', array(
    'page' => 1,
    '_controller' => 'Api\\Controller\\ArticleController::indexAction'
));
$router->addGet('show_article', '/blog/article/{id}', array(
    '_controller' => 'Api\\Controller\\ArticleController::showAction'
), array(
    'id' => '\d+'
));
$router->addGet('delete_article', '/blog/article/delete/{id}', array(
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

$router->addMethods('new_category', '/blog/category/new', array(
    '_controller' => 'Api\\Controller\\CategoryController::newAction'
), [], array(
    'POST',
    'GET'
));

$router->addMethods('edit_category', '/blog/category/edit/{id}', array(
    '_controller' => 'Api\\Controller\\CategoryController::editAction'
), [], array(
    'POST',
    'GET'
));
$router->addGet('categories', '/blog/categories/{page}', array(
    'page' => 1,
    '_controller' => 'Api\\Controller\\CategoryController::indexAction'
), array(
    'id' => '\d+'
));
$router->addGet('show_category', '/blog/category/{id}', array(
    '_controller' => 'Api\\Controller\\CategoryController::showAction'
), array(
    'id' => '\d+'
));
$router->addGet('delete_category', '/blog/category/delete/{id}', array(
    '_controller' => 'Api\\Controller\\CategoryController::deleteAction'
));


//REST API CONTROLLERS

// REST API LISTS ACTIONS 
$router->addGet('articles_list', '/articles', array(
    '_controller' => 'Api\\Controller\\ArticlesController::listAction'
));
$router->addGet('categories_list', '/categories', array(
    '_controller' => 'Api\\Controller\\CategoriesController::listAction'
));
$router->addGet('galleries_list', '/galleries', array(
    '_controller' => 'Api\\Controller\\GalleriesController::listAction'
));
$router->addGet('photos_list', '/photos', array(
    '_controller' => 'Api\\Controller\\PhotosController::listAction'
));
$router->addGet('users_list', '/users', array(
    '_controller' => 'Api\\Controller\\UsersController::listAction'
));

// REST API SHOW ACTIONS 
$router->addGet('article_show', '/articles/{id}', array(
    '_controller' => 'Api\\Controller\\ArticlesController::showAction'
), array(
    'id' => '\d+'
));
$router->addGet('category_show', '/categories/{id}', array(
    '_controller' => 'Api\\Controller\\CategoriesController::showAction'
), array(
    'id' => '\d+'
));
$router->addGet('gallery_show', '/galleries/{id}', array(
    '_controller' => 'Api\\Controller\\GalleriesController::showAction'
), array(
    'id' => '\d+'
));
$router->addGet('photo_show', '/photos/{id}', array(
    '_controller' => 'Api\\Controller\\PhotosController::showAction'
), array(
    'id' => '\d+'
));
$router->addGet('user_show', '/users/{id}', array(
    '_controller' => 'Api\\Controller\\UsersController::showAction'
), array(
    'id' => '\d+'
));

// REST API NEW ACTIONS 

$router->addGet('article_new', '/articles', array(
    '_controller' => 'Api\\Controller\\ArticlesController::newAction'
));
$router->addPost('category_new', '/categories', array(
    '_controller' => 'Api\\Controller\\CategoriesController::newAction'
));

// REST API UPDATE ACTIONS
$router->addPut('category_update', '/categories/{id}', array(
    '_controller' => 'Api\\Controller\\CategoriesController::updateAction'
), array(
    'id' => '\d+'
));


// REST API DELETE ACTIONS
$router->addDelete('category_delete', '/categories/{id}', array(
    '_controller' => 'Api\\Controller\\CategoriesController::deleteAction'
), array(
    'id' => '\d+'
));
return $router->getRouteCollection();
