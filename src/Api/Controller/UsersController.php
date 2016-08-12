<?php

namespace Api\Controller;

use Api\Model\Galleries;
use Api\Model\Photos;
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

    /**
     * @return Users
     */
    public function getUsersModel()
    {
        $Model = new Users($this->databaseConnection());
        return $Model;
    }


}