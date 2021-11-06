<?php

namespace app\models;

use ErrorException;
use Yii;
use yii\base\Model;
use yii\db\Exception;
use yii\web\UploadedFile;

class UploadImage extends Model
{
    public $image;


    public function rules()
    {
        return [
            [['image'], 'required'],
            [['image'], 'file', 'extensions' => 'jpeg,jpg,png']
        ];
    }

    public function uploadFile(UploadedFile $file, $currentNameImage)
    {
        $this->image = $file;

        if ($this->validate()) {
            if ($this->checkFileExists($currentNameImage)) {
                try {
                    $this->deleteFileInSystem($currentNameImage);
                } catch (ErrorException $e) {
                    throw new Exception('не удалось удалить файл');
                }
            }
            return $this->saveImage();
        }
    }

    private function getFolderForUploadFile()
    {
        return Yii::getAlias('@web') . 'uploads/';
    }

    private function generateRandFileName()
    {
        return strtolower(md5(uniqid($this->image->baseName))) . '.' . $this->image->extension;
    }

    public function checkFileExists($currentNameImage)
    {
        return file_exists($this->getFolderForUploadFile() . $currentNameImage) && !empty($currentNameImage);
    }

    public function deleteFileInSystem($currentNameImage)
    {
        try {
            unlink($this->getFolderForUploadFile() . $currentNameImage);
        }catch (\Exception $exception){
            throw new ErrorException('не удалось удалить файл');
        }
    }

    public function saveImage()
    {
        $fileName = $this->generateRandFileName();

        $this->image->saveAs($this->getFolderForUploadFile() . $fileName);

        return $fileName;
    }
}