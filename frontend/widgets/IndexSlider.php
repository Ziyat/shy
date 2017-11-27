<?php

namespace frontend\widgets;

use backend\models\Slider;
use yii\bootstrap\Widget;

class IndexSlider extends Widget
{

   public function init()
   {

   }

   public function run()
   {
      return $this->render('index-slider', [
            'sliders' => Slider::find()->all()
      ]);
   }

}