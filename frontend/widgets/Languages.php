<?php

namespace frontend\widgets;

use frontend\models\Lang;
use yii\bootstrap\Widget;
use yii\helpers\Url;

class Languages extends Widget {

   public function init() {

   }

   public function run() {
      return $this->render('languages', [
            'current' => Lang::getCurrent(),
            'current_url' => mb_strcut(Url::current(), 4)
      ]);
   }

}
