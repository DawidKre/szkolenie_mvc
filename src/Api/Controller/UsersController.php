<?php

namespace Api\Controller;

use Api\Model\Users;
use Core\Controller;

class UsersController extends Controller
{
    public function listAction()
    {
        $list = $this->getUsersModel()->getList();
        return $this->render('', array(
            'users' => $list
        ));
    }

    public function showAction($id)
    {
        $article = $this->getUsersModel()->getUser($id);
        return $this->render('', array(
            'user' => $article
        ));
    }

    /**
     * @return Users
     */
    public function getUsersModel()
    {
        $Model = $this->pdo(Users::class);
        return $Model;
    }


}