<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\helpers\Html;

/**
 * ContactForm is the model behind the contact form.
 */
class Helper extends Model
{

   public function checkEmpty($label, $attr)
   {
      if ($attr) {
         return '<tr><td class="first">' . $label . ':</td><td>' . Html::encode($attr) . '</td></tr>';
      }
   }

   public function keywords($attr, $type)
   {
      $r = explode(',', $attr);
      $count = count($r);
      $str = '';
      for ($i = 0; $i < $count; $i++) {
         $str .= Html::a($r[$i], [$type . '/genre', 'k' => trim($r[$i])], ['class' => 'keyword-item']);
         if ($i + 1 < $count)
            $str .= ', ';
      }
      return $str;
   }

   public function keywordList($model, $type)
   {
//      $keywords = $model->getKeywordsArray();
//      $str = '';
//      if ($keywords) {
//         echo "<pre>" . print_r($keywords, true);
//         die;
//         foreach ($keywords as $k) {
//            $str .= Html::a($k->title_ru, [$type . '/genre', 'k' => trim($k->title_ru)], ['class' => 'keyword-item']);
//         }
//      }
//      return trim($str, ',');
   }

   /**
    * logic not ready
    */
   public function labelHD($var = null)
   {
      return $var ? '<span class = "label label-default hd">HD</span>' : '';
   }

   /**
    *
    */
   public function labelNew($release_time = null)
   {
      if ((time() - Yii::$app->params['new-limit']) < $release_time) {
         return'<span class="label label-default new">' . Yii::t('app', 'New') . '</span>';
      }
   }

   /**
    *
    */
   public function labelSeason($season_number)
   {
      return'<span class="label label-default season">' . Yii::t('app', 'Season') . ' ' . $season_number . '</span>';
   }

   public function fileSrc($file)
   {
      $a = strptime('24-01-2017', '%d-%m-%Y'); //24 yanvardan yangi ...frontend/web/files/new/ direktoriya qo`shildi
      $newAgeTimePoint = mktime(0, 0, 0, $a['tm_mon'] + 1, $a['tm_mday'], $a['tm_year'] + 1900);
      $path = $file->uploaded_at > $newAgeTimePoint ? Yii::getAlias('@new-files') : Yii::getAlias('@files');
      $is_new = $file->uploaded_at > $newAgeTimePoint ? true : false;
      return $is_new ? "https://mediabox.uz/files/new/" : "https://mediabox.uz/files/";
////      if (YII_ENV == 'prod') {
//      return "https://mediabox.uz/files/new/";
////      }else{
////         return $path . '/';
////      }
   }

   public function poster($model, $size = 160)
   {
       if(is_array($model))
       {
           return Yii::getAlias('https://mediabox.uz/posters/' . $model['poster'] . '/' . $model['poster'] . $size . '.jpg');
       }
//      if (YII_ENV == 'prod') {
      return Yii::getAlias('https://mediabox.uz/posters/' . $model->poster . '/' . $model->poster . $size . '.jpg');
//      } else {
//         return Yii::getAlias('@posters/' . $model->poster . '/' . $model->poster . $size . '.jpg');
//      }
   }

}