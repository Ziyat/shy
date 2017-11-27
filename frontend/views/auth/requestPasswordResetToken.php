<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = Yii::t('app', 'Request password reset');
?>
<div class="container">
   <!-- <form class="form-horizontal" action="reg.php" method="get" role="form"> -->
   <div class="col-md-6 col-md-offset-3 paper">
      <h1 class=""><?= Html::encode($this->title) ?></h1>

      <p><?= Yii::t('app', 'Please fill out your email. A link to reset password will be sent to your mail.') ?></p>
      <?php $form = ActiveForm::begin(['action' => ['/auth/login'], 'id' => 'login-form', 'class' => 'login-form']); ?>
      <?= $form->errorSummary($model) ?>
      <?= $form->field($model, 'email')->label(false)->textInput(['autofocus' => true, 'placeholder' => $model->getAttributeLabel('email')]) ?>
      <div>
         <button type="submit" class="btn btn-default btn-mediabox"><?= Yii::t('app', 'Send') ?></button>
         <br>
         <br>
      </div>
   <?php ActiveForm::end(); ?>
</div>
</div>