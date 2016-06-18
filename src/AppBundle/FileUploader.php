<?php
/**
 * Created by PhpStorm.
 * User: bob
 * Date: 18/06/16
 * Time: 16:37
 */

namespace AppBundle;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader {

  private $fileDir;

  /**
   * FileUploader constructor.
   * @param $fileDir
   */
  public function __construct($fileDir) {
    $this->fileDir = $fileDir;
  }

  public function upload(UploadedFile $file){
    $fileName = md5(uniqid()).'.'.$file->guessExtension();
    $file->move($this->fileDir,$fileName);
    return $fileName;
  }

}