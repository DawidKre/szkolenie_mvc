<?php

namespace Api\Controller;

use Api\Model\Users;
use Core\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
{


    public function listAction(Request $request)
    {
        $pageParameter = $request->get('page');
        $limit = $request->get('limit');
        if ($limit > 20) $limit = 20;
        $currentPage = isSet($pageParameter) ? intval($pageParameter - 1) : 0;
        $from = $currentPage * $limit;
        $count = $this->getUsersModel()->getTotalRecords();
        $totalPages = ceil($count / $limit);
        $list = $this->getUsersModel()->getPaginationList($from, $limit);

        return $this->render('', array(
            'users' => $list,
            'limit' => intval($limit),
            'total_pages' => $totalPages,
            'count' => $count,
        ));
    }

    public function showAction($id)
    {
        $user = $this->getUsersModel()->getUser($id);
        $articles = $this->getUsersModel()->getUserArticles($id);
        $comments = $this->getUsersModel()->getUserComments($id);
        return $this->render('', array(
            'user' => $user,
            'articles' => $articles,
            'comments' => $comments
        ));
    }

    public function newAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $usrName = $data['usr_name'];
        $usrPassword = $data['usr_password'];
        $usrEmail = $data['usr_email'];
        $usrStatus = $data['usr_status'];
        $usrRole = $data['usr_role'];
        $usrDate = $data['usr_date'];

        if (($this->getUsersModel()->createUser($usrName, $usrPassword, $usrEmail, $usrStatus, $usrRole, $usrDate))) {
            return $this->render('', array(
                'status' => Response::HTTP_CREATED
            ), 201);
        }
        return $this->render('', array(
            'status' => 404
        ));
    }

    public function updateAction(Request $request, $id)
    {
        $data = json_decode($request->getContent(), true);
        
        $user = $this->getUsersModel()->getUser($id);

        $usrName = $data['usr_name'];
        $usrPassword = $data['usr_password'];
        $usrEmail = $data['usr_email'];
        $usrStatus = $data['usr_status'];
        $usrRole = $data['usr_role'];
        $usrDate = $data['usr_date'];

        if ($usrName == '') $usrName = $user['usr_name'];
        if ($usrPassword == '') $usrPassword = $user['usr_password'];
        if ($usrEmail == '') $usrEmail = $user['usr_email'];
        if ($usrStatus == '') $usrStatus = $user['usr_status'];
        if ($usrRole == '') $usrRole = $user['usr_role'];
        if ($usrDate == '') $usrDate = $user['usr_date'];

        if (($this->getUsersModel()->updateUser($id, $usrName, $usrPassword, $usrEmail, $usrStatus, $usrRole, $usrDate))) {
            return $this->render('', array(
                'status' => Response::HTTP_OK
            ));
        }
        return $this->render('', array(
            'status' => 404
        ));
    }

    public function deleteAction($id)
    {
        if (($this->getUsersModel()->getUser($id))) {
            $this->getUsersModel()->deleteUser($id);
            return $this->render('', array(
                'status' => Response::HTTP_OK
            ));
        }
        return $this->render('', array(
            'status' => Response::HTTP_NOT_FOUND
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