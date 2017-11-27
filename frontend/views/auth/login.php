<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = Yii::t('app', 'Login');
?>

<br>
<div class="container">
    <div class="row">
        <div class="loginmodal-container col-sm-4 col-sm-offset-4 papers">
            <h1><?= Html::encode($this->title) ?></h1><br>

            <?php $form = ActiveForm::begin(['action' => ['/auth/login'], 'id' => 'login-form', 'class' => 'login-form']); ?>

            <?php //= $form->errorSummary($model)  ?>

            <?= $form->field($model, 'username')->label(false)->textInput(['autofocus' => true, 'placeholder' => $model->getAttributeLabel('username')]) ?>

            <?= $form->field($model, 'password')->label(false)->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

            <?= $form->field($model, 'rememberMe')->checkbox() ?>

            <input type="submit" name="login" class="login loginmodal-submit" value="<?= Yii::t('app', 'Login') ?>">

            <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />

                <!--<p class="message"><?= Yii::t('app', 'If you don`t have account') ?></p>-->
                <br>
            <?php ActiveForm::end(); ?>

            <div class="login-help">
                <?= Html::a(Yii::t('app', 'Signup'), ['/auth/signup']) ?> <br> <?= Html::a(Yii::t('app', 'reset it'), ['/auth/request-password-reset']) ?>
            </div>

        </div>
    </div>
</div>
<br>
<br>