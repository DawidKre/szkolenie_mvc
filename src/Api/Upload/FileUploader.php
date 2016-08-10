<?php
/**
 * Created by PhpStorm.
 * User: dawid
 * Date: 10.08.16
 * Time: 13:52
 */

namespace Api\Upload;


use Imagine\Gd\Imagine;
use Imagine\Image\Box;
use Imagine\Image\ImageInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    private $targetDir;

    public function __construct($targetDir)
    {
        $this->targetDir = $targetDir;
    }

    public function upload(UploadedFile $file)
    {
        $orgFileName = md5(uniqid()) . '.' . $file->guessExtension();
        $file->move($this->targetDir, $orgFileName);

        $fileName = 'cover_' . $orgFileName;
        $imagine = new Imagine();
        $size = new Box(200, 200);
        $mode = ImageInterface::THUMBNAIL_OUTBOUND;
        $imagine->open($this->targetDir . '/' . $orgFileName)
            ->thumbnail($size, $mode)
            ->save($this->targetDir . '/' . $fileName);


        return $fileName;
    }
}