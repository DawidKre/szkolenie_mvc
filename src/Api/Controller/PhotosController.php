<?php

namespace Api\Controller;

use Api\Model\Galleries;
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

    /**
     * @return Photos
     */
    public function getPhotosModel()
    {
        $Model = new Photos($this->databaseConnection());
        return $Model;
    }


}