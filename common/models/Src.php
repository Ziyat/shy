<?php

namespace common\models;

use Yii;
use yii\base\Exception;
use yii\base\Model;
use yii\helpers\BaseFileHelper;
use yii\imagine\Image;

const APP_IMAGES = 'app-images';
const STORE = 'store';
const CACHE = 'cache';
const PLACEHOLDER_DIR = APP_IMAGES . DIRECTORY_SEPARATOR . CACHE . DIRECTORY_SEPARATOR . 'placeholder';

class Src extends Model
{

   public function imgSrc($model, $attr = 'thumb', $sizeX = '', $sizeY = '')
   {


      if (!$model) {
         self::checkDir(Yii::getAlias('@webfolder/' . PLACEHOLDER_DIR));
         return Yii::getAlias('/' . PLACEHOLDER_DIR . DIRECTORY_SEPARATOR . $attr . '-' . $sizeX . 'x' . $sizeY . '.jpg');
      }


//      return $attr . '-' . $sizeX . 'x' . $sizeY . '.jpg';

      if (!$sizeY && !$sizeX) {
         return self::originSrc($model, $attr);
      }
      $realStored = self::realStored($model, $attr);
      if (is_file($realStored)) {
         $sizes = getimagesize($realStored);
//         if (!$sizeX) {
//            $sizeX = intval($sizes[0] * ($sizeY / $sizes[1]));
//         } elseif (!$sizeY) {
//            $sizeY = intval($sizes[1] * ($sizeX / $sizes[0]));
      }
//      } else {
      if (!$sizeY) {
         $sizeY = $sizeX;
      }
//      }

      $image = $attr . '-' . $sizeX . 'x' . $sizeY . '.jpg';
      $realCached = self::realCached($model, $image);

      if (is_file($realCached)) {
         return self::srcCached($model, $image);
      }

      self::checkDir(self::realDirName($model, STORE));
      self::checkDir(self::realDirName($model, CACHE));
      if (!is_file($realStored) || $model->isNewRecord) {
         $realPlaceholderCached = Yii::getAlias('@webfolder/' . PLACEHOLDER_DIR . DIRECTORY_SEPARATOR . $image);
         if (!is_file($realPlaceholderCached)) {
            self::checkDir(Yii::getAlias('@webfolder/' . PLACEHOLDER_DIR));
            self::doImage(Yii::getAlias('@webfolder/' . APP_IMAGES . '/placeholder.png'), $sizeX, $sizeY, $realPlaceholderCached);
         }
         return Yii::getAlias('/' . PLACEHOLDER_DIR . DIRECTORY_SEPARATOR . $image);
      }
      self::doImage($realStored, $sizeX, $sizeY, $realCached);
      return self::srcCached($model, $image);
   }

   // add update cache and file
   public function imageSaver($model, $attr = 'thumb', $update = false)
   {
      if ($model->$attr) {
         self::checkDir(self::realDirName($model, STORE));
         $realStored = self::realStored($model, $attr);
         if ($update && is_file($realStored)) {
            unlink($realStored);
         }
         BaseFileHelper::removeDirectory(self::realDirName($model, CACHE));
         $model->$attr->saveAs($realStored);
         return true;
      }
      return false;
   }

   public function delete($model)
   {
      $dirStore = Yii::getAlias('@webfolder/' . self::realDir($model, STORE));
      if (is_dir($dirStore)) {
         BaseFileHelper::removeDirectory($dirStore);
      }
      $dirCache = Yii::getAlias('@webfolder/' . self::realDir($model, CACHE));
      if (is_dir($dirCache)) {
         BaseFileHelper::removeDirectory($dirCache);
      }
   }

   public function originSrc($model, $attr)
   {
      return Yii::getAlias('/' . self::realDir($model, STORE) . DIRECTORY_SEPARATOR . self::origin($attr));
   }

   private function doImage($realStored, $sizeX, $sizeY, $realCached)
   {
      try {
         Image::thumbnail($realStored, $sizeX, $sizeY)->save($realCached, ['quality' => 90]);
//         $I = Image::getImagine();
//         $I->resize($realStored, $sizeX, $sizeY)->save($realCached, ['quality' => 90]);
      } catch (Exception $e) {
         throw new Exception("Failed create thumbnail image - " . $e->getMessage(), $e->getCode(), $e);
      }
   }

   private function realStored($model, $attr)
   {
      return Yii::getAlias('@webfolder' . DIRECTORY_SEPARATOR . self::realDir($model, STORE) . DIRECTORY_SEPARATOR . self::origin($attr));
   }

   private function realCached($model, $image)
   {
      return Yii::getAlias('@webfolder' . DIRECTORY_SEPARATOR . self::realDir($model, CACHE) . DIRECTORY_SEPARATOR . $image);
   }

   private function realDir($model, $dirName)
   {
      $table = $model->tableName();
      $id = in_array($table, ['film', 'serial_item', 'tv']) ? $model->file_id : $model->id;
      return APP_IMAGES . DIRECTORY_SEPARATOR . $dirName . DIRECTORY_SEPARATOR . $model->tableName() . '/' . $id;
   }

   private function realDirName($model, $dirname)
   {
      return Yii::getAlias('@webfolder' . DIRECTORY_SEPARATOR . self::realDir($model, $dirname));
   }

   private function origin($attr)
   {
      return $attr . '-ORIGINAL';
   }

   private function srcCached($model, $image)
   {
      return Yii::getAlias('/' . self::realDir($model, CACHE) . DIRECTORY_SEPARATOR . $image);
   }

   private function checkDir($dir)
   {
      if (!is_dir($dir)) {
         BaseFileHelper::createDirectory($dir, 0775, true);
      }
   }

}