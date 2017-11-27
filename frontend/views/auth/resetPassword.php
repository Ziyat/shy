<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Reset password';
?>
<div class="site-reset-password">
   <div class="login-page">
      <div class="form">
         <h1><?= Html::encode($this->title) ?></h1>
         <p>Please choose your new password:</p>
         <?php $form = ActiveForm::begin(['action' => ['login'], 'id' => 'login-form', 'class' => 'login-form']); ?>
         <?= $form->errorSummary($model) ?>
         <?= $form->field($model, 'password')->label(false)->passwordInput(['autofocus' => true, 'placeholder' => $model->getAttributeLabel('password')]) ?>
         <?= Html::submitButton(Yii::t('app', 'Save')) ?>
         <?php ActiveForm::end(); ?>
      </div>
   </div>
</div>