<?php

namespace Api\Controller;

use Api\Model\Users;
use Core\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
{
    public $limit = 4;

    public function listAction(Request $request)
    {
        $pageParameter = $request->get('page');
        $currentPage = isSet($pageParameter) ? intval($pageParameter - 1) : 0;
        $from = $currentPage * $this->limit;
        $count = $this->getUsersModel()->getTotalRecords();
        $totalPages = ceil($count / $this->limit);
        $list = $this->getUsersModel()->getPaginationList($from, $this->limit);

        return $this->render('', array(
            'users' => $list,
            'limit' => $this->limit,
            'total_pages' => $totalPages,
            'count' => $count,
        ));
    }

    public function showAction($id)
    {
        $article = $this->getUsersModel()->getUser($id);
        return $this->render('', array(
            'user' => $article
        ));
    }

    public function newAction(Request $request)
    {
        $usrName = $request->get('usr_name');
        $usrPassword = $request->get('usr_password');
        $usrEmail = $request->get('usr_email');
        $usrStatus = $request->get('usr_status');
        $usrRole = $request->get('usr_role');
        $usrDate = $request->get('usr_date');

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
        $user = $this->getUsersModel()->getUser($id);

        $usrName = $request->request->get('usr_name');
        $usrPassword = $request->request->get('usr_password');
        $usrEmail = $request->request->get('usr_email');
        $usrStatus = $request->request->get('usr_status');
        $usrRole = $request->request->get('usr_role');
        $usrDate = $request->request->get('usr_date');

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