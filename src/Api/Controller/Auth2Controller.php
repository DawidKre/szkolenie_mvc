<?php

namespace Api\Controller;

use Api\Model\Users;
use Core\Controller;
use Firebase\JWT\JWT;
use Symfony\Component\HttpFoundation\Request;


class Auth2Controller extends Controller
{

    public function authAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $username = $data['usr_name'];
        $userPassword = $data['usr_password'];

        if (($user = $this->getUsersModel()->getUserByUsername($username)) > 0) {
            if (password_verify($userPassword, $user['usr_password'])) {

                $key = "key_super_secure";
                $payload = [
                    'usr_id' => $user['usr_id'],
                    'usr_name' => $user['usr_name'],
                    'usr_email' => $user['usr_email'],
                    'exp' => time() + 6000
                ];

                $token = JWT::encode($payload, $key);
                return $this->render('', array(
                    'status' => 0,
                    'token' => $token
                ));
            } else {
                return $this->render('', array(
                    'status' => -1
                ));
            }

        } else {
            return $this->render('', array(
                'status' => 404
            ));
        }

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