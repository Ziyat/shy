<?php

use common\models\Src;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = Yii::t('app', 'Profile');
?>
<div class="box box-info">
   <div class="container">
      <div class="col-sm-8 col-sm-offset-2 paper">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->
         <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
         <?= $form->errorSummary($model); ?>

         <div class="row">
            <div class="col-sm-4 col-sm-offset-4">
               <div class="form-group" id="image-for-show">
                  <img src="<?= Src::imgSrc($model, 'thumb', 160) ?>" alt="" class="img-circle img-responsive" style="width: 100%; height: auto;">
               </div>
            </div>
            <div class="col-sm-4 col-sm-offset-4">
               <?= $form->field($model, 'thumb')->label(false)->fileInput()//->hint('для вывода с названием')   ?>
            </div>
         </div>
         <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
               <?= $form->field($model, 'username')->label()->textInput(['autofocus' => true, 'placeholder' => $model->getAttributeLabel('username')]) ?>
               <?= $form->field($model, 'email')->label()->textInput(['placeholder' => $model->getAttributeLabel('email')]) ?>
               <?= $form->field($model, 'pass')->label(Yii::t('app', 'New password'))->passwordInput() ?>
            </div>
         </div>
         <div class="col-sm-12">
            <?= Html::submitButton(Yii::t('app', 'Update'), ['class' => 'btn btn-default btn-mediabox centeredbutton']) ?>
         </div>
         <?php ActiveForm::end(); ?>
         <br>
         <br>
      </div>
   </div>
</div>