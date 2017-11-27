<?php

namespace frontend\widgets;

use yii\bootstrap\Widget;

class IndexCollections extends Widget {

   public function init() {

   }

   public function run() {
      return $this->render('index-collections');
   }

}
