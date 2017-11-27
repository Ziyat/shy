<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $model backend\models\user\User */

$this->title = Yii::t('app', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-form">

   <?php $form = ActiveForm::begin(); ?>
   <div class="row">
      <div class="col-sm-3">
         <?= $form->field($model, 'balans')->textInput(['maxlength' => true]) ?>
      </div>
   </div>

   <div class="form-group">
      <?= Html::submitButton(Yii::t('app', 'Update'), ['class' => 'btn btn-success']) ?>
   </div>

   <?php ActiveForm::end(); ?>

</div>