<?php

namespace Api\Controller;

use Api\Model\Galleries;
use Api\Upload\FileUploader;
use Core\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Imagine\Gd\Imagine;
use Imagine\Image\Box;
use Imagine\Image\ImageInterface;


class GalleriesController extends Controller
{


    public function listAction(Request $request)
    {
        $pageParameter = $request->get('page');
        $limit = $request->get('limit');
        if ($limit > 20) $limit = 20;
        $currentPage = isSet($pageParameter) ? intval($pageParameter - 1) : 0;
        $from = $currentPage * $limit;
        $count = $this->getGalleriesModel()->getTotalRecords();
        $totalPages = ceil($count / $limit);
        $list = $this->getGalleriesModel()->getPaginationList($from, $limit);
        return $this->render('', array(
            'galleries' => $list,
            'limit' => intval($limit),
            'total_pages' => $totalPages,
            'count' => $count,
        ));
    }

    public function showAction($id)
    {
        $article = $this->getGalleriesModel()->getGallery($id);
        $photos = $this->getGalleriesModel()->getPhotosList($id);
        $articles = $this->getGalleriesModel()->getArticlesList($id);
        return $this->render('', array(
            'gallery' => $article,
            'photos' => $photos,
            'articles' => $articles
        ));
    }

    public function newAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $galName = $data['gal_name'];

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

        $data = json_decode($request->getContent(), true);
        $galName = $data['gal_name'];

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

    public function newPhotoAction(Request $request)
    {

        $file = $request->files->all();
        print_r($file);
        $targetDir = __DIR__ . '/../public/img2/';

        $uploader = new FileUploader($targetDir);

        if (isset($file)) {
            foreach ($file['file'] as $file) {

                $fileName = $uploader->upload($file);
                if ($fileName) {
                    echo json_encode(array(
                        'status' => true,
                        'generatedName' => $fileName
                    ));
                }

                $phtSrc = $targetDir . '/' . $fileName;
                $phtStorage = $fileName;
                $phtMain = 2;
                $phtGalId = 1;
                $this->getGalleriesModel()->createPhoto($phtSrc, $phtStorage, $phtMain, $phtGalId);
            }
        } else {
            echo json_encode(
                array('status' => false, 'msg' => 'No file uploaded.')
            );
            return $this->render('', array(
                'status' => 404
            ));

        }
        return $this->render('', array(
            'status' => Response::HTTP_CREATED
        ), 201);
    }

    public function updatePhotoAction(Request $request, $id)
    {
        $photo = $this->getGalleriesModel()->getPhoto($id);

        $phtSrc = $request->request->get('pht_src');
        $phtStorage = $request->request->get('pht_storage');
        $phtMain = $request->request->get('pht_main');
        $phtGalId = $request->request->get('pht_gal_id');

        if ($phtSrc == '') $phtSrc = $photo['pht_src'];
        if ($phtStorage == '') $phtStorage = $photo['pht_storage'];
        if ($phtMain == '') $phtMain = $photo['pht_main'];
        if ($phtGalId == '') $phtGalId = $photo['pht_gal_id'];


        if (($this->getGalleriesModel()->updatePhoto($id, $phtSrc, $phtStorage,
            $phtMain, $phtGalId))
        ) {
            return $this->render('', array(
                'status' => Response::HTTP_OK
            ));
        }
        return $this->render('', array(
            'status' => 404
        ));
    }

    public function deletePhotoAction($id)
    {
        if (($this->getGalleriesModel()->getPhoto($id))) {
            $this->getGalleriesModel()->deletePhoto($id);
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