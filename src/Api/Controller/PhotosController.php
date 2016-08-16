<?php

namespace Api\Controller;

use Api\Model\Photos;
use Core\Controller;

class PhotosController extends Controller
{
    public function listAction()
    {
        $list = $this->getPhotosModel()->getList();
        return $this->render('', array(
            'photos' => $list
        ));
    }

    public function showAction($id)
    {
        $article = $this->getPhotosModel()->getPhoto($id);
        return $this->render('', array(
            'photo' => $article
        ));
    }

    /**
     * @return Photos
     */
    public function getPhotosModel()
    {
        $Model = $this->pdo(Photos::class);
        return $Model;
    }


}