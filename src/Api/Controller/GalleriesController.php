<?php

namespace Api\Controller;

use Api\Model\Galleries;
use Core\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GalleriesController extends Controller
{
    public function listAction()
    {
        $list = $this->getGalleriesModel()->getList();
        return $this->render('', array(
            'galleries' => $list
        ));
    }

    public function showAction($id)
    {
        $article = $this->getGalleriesModel()->getGallery($id);
        $photos = $this->getGalleriesModel()->getPhotosList($id);
        return $this->render('', array(
            'gallery' => $article,
            'photos' => $photos
        ));
    }

    public function newAction(Request $request)
    {
        $galName = $request->get('gal_name');

        if (($this->getGalleriesModel()->createGallery($galName))) {
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
        $gallery = $this->getGalleriesModel()->getGallery($id);
        $galName = $request->request->get('gal_name');

        if ($galName == '') $galName = $gallery['gal_name'];

        if (($this->getGalleriesModel()->updateGallery($id, $galName))) {
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
        if (($this->getGalleriesModel()->getGallery($id))) {
            $this->getGalleriesModel()->deleteGallery($id);
            return $this->render('', array(
                'status' => Response::HTTP_OK
            ));
        }
        return $this->render('', array(
            'status' => Response::HTTP_NOT_FOUND
        ));
    }
    /**
     * @return Galleries
     */
    public function getGalleriesModel()
    {
        $Model = $this->pdo(Galleries::class);
        return $Model;
    }


}