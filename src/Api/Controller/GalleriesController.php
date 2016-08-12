<?php

namespace Api\Controller;

use Api\Model\Galleries;
use Core\Controller;

class GalleriesController extends Controller
{
    public function listAction()
    {
        $list = $this->getGalleriesModel()->getList();
        return $this->render('', array(
            'galleries' => $list
        ));
    }

    /**
     * @return Galleries
     */
    public function getGalleriesModel()
    {
        $Model = new Galleries($this->databaseConnection());
        return $Model;
    }


}