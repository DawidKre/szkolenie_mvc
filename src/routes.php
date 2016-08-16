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
$router->addGet('articles_list', '/articles/{page}/{limit}', array(
    'page' => 1,
    'limit' => 5,
    '_controller' => 'Api\\Controller\\ArticlesController::listAction'
), array(
    'id' => '\d+',
    'limit' => '\d+'
));
$router->addGet('categories_list', '/categories/{page}/{limit}', array(
    'page' => 1,
    'limit' => 5,
    '_controller' => 'Api\\Controller\\CategoriesController::listAction'
), array(
    'id' => '\d+',
    'limit' => '\d+'
));
$router->addGet('galleries_list', '/galleries/{page}/{limit}', array(
    'page' => 1,
    'limit' => 5,
    '_controller' => 'Api\\Controller\\GalleriesController::listAction'
), array(
    'id' => '\d+',
    'limit' => '\d+'
));
$router->addGet('photos_list', '/photos', array(
    'page' => 1,
    '_controller' => 'Api\\Controller\\PhotosController::listAction'
), array(
    'id' => '\d+'
));
$router->addGet('users_list', '/users/{page}/{limit}', array(
    'page' => 1,
    'limit' => 5,
    '_controller' => 'Api\\Controller\\UsersController::listAction'
), array(
    'id' => '\d+',
    'limit' => '\d+'
));


// REST API SHOW ACTIONS 
$router->addGet('article_show', '/article/{id}', array(
    '_controller' => 'Api\\Controller\\ArticlesController::showAction'
), array(
    'id' => '\d+'
));
$router->addGet('category_show', '/category/{id}', array(
    '_controller' => 'Api\\Controller\\CategoriesController::showAction'
), array(
    'id' => '\d+'
));
$router->addGet('gallery_show', '/gallery/{id}', array(
    '_controller' => 'Api\\Controller\\GalleriesController::showAction'
), array(
    'id' => '\d+'
));
$router->addGet('photo_show', '/photo/{id}', array(
    '_controller' => 'Api\\Controller\\PhotosController::showAction'
), array(
    'id' => '\d+'
));
$router->addGet('user_show', '/user/{id}', array(
    '_controller' => 'Api\\Controller\\UsersController::showAction'
), array(
    'id' => '\d+'
));

// REST API NEW ACTIONS 

$router->addPost('article_new', '/articles', array(
    '_controller' => 'Api\\Controller\\ArticlesController::newAction'
));
$router->addPost('category_new', '/categories', array(
    '_controller' => 'Api\\Controller\\CategoriesController::newAction'
));
$router->addPost('gallery_new', '/galleries', array(
    '_controller' => 'Api\\Controller\\GalleriesController::newAction'
));
$router->addPost('user_new', '/users', array(
    '_controller' => 'Api\\Controller\\UsersController::newAction'
));
$router->addPost('comment_new', '/comments', array(
    '_controller' => 'Api\\Controller\\ArticlesController::newCommentAction'
));
$router->addPost('photo_new', '/photo', array(
    '_controller' => 'Api\\Controller\\GalleriesController::newPhotoAction'
));

// REST API UPDATE ACTIONS
$router->addPut('category_update', '/categories/{id}', array(
    '_controller' => 'Api\\Controller\\CategoriesController::updateAction'
), array(
    'id' => '\d+'
));

$router->addPut('article_update', '/articles/{id}', array(
    '_controller' => 'Api\\Controller\\ArticlesController::updateAction'
), array(
    'id' => '\d+'
));

$router->addPut('gallery_update', '/galleries/{id}', array(
    '_controller' => 'Api\\Controller\\GalleriesController::updateAction'
), array(
    'id' => '\d+'
));

$router->addPut('user_update', '/users/{id}', array(
    '_controller' => 'Api\\Controller\\UsersController::updateAction'
), array(
    'id' => '\d+'
));

$router->addPut('comment_update', '/comments/{id}', array(
    '_controller' => 'Api\\Controller\\ArticlesController::updateCommentAction'
), array(
    'id' => '\d+'
));
$router->addPut('photo_update', '/photos/{id}', array(
    '_controller' => 'Api\\Controller\\GalleriesController::updatePhotoAction'
), array(
    'id' => '\d+'
));

// REST API DELETE ACTIONS
$router->addDelete('gallery_delete', '/galleries/{id}', array(
    '_controller' => 'Api\\Controller\\GalleriesController::deleteAction'
), array(
    'id' => '\d+'
));
$router->addDelete('article_delete', '/articles/{id}', array(
    '_controller' => 'Api\\Controller\\ArticlesController::deleteAction'
), array(
    'id' => '\d+'
));

$router->addDelete('gallery_delete', '/galleries/{id}', array(
    '_controller' => 'Api\\Controller\\GalleriesController::deleteAction'
), array(
    'id' => '\d+'
));
$router->addDelete('comment_delete', '/comments/{id}', array(
    '_controller' => 'Api\\Controller\\ArticlesController::deleteCommentAction'
), array(
    'id' => '\d+'
));
$router->addDelete('photo_delete', '/photos/{id}', array(
    '_controller' => 'Api\\Controller\\GalleriesController::deletePhotoAction'
), array(
    'id' => '\d+'
));
return $router->getRouteCollection();
