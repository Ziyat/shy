<?php

use backend\models\Profile;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::t('app', 'Signup');
?>
<div class="container">

    <div class="row">
        <div class="col-md-6 col-md-offset-3 paper">

            <h2 class="page-header"><?= Html::encode($this->title) ?></h2>

            <?php $form = ActiveForm::begin(['id' => 'form-signup', 'class' => 'register-form']); ?>
            <?php echo $form->errorSummary($model); ?>

            <?= $form->field($model, 'username')->label(false)->textInput(['autofocus' => true, 'placeholder' => $model->getAttributeLabel('username')]) ?>
            <?= $form->field($model, 'email')->label(false)->textInput(['placeholder' => $model->getAttributeLabel('email')]) ?>
          <!-- <input type="text" placeholder="Телефон номер"/> -->
            <?= $form->field($model, 'password')->label(false)->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>
            <?= $form->field($model, 'password_repeat')->label(false)->passwordInput(['placeholder' => $model->getAttributeLabel('password_repeat')]) ?>
            <?=
            $form->field($model, 'gender')->dropDownList([
               Profile::GENDER_FEMALE => Yii::t('app', Profile::GENDER_FEMALE_STRING),
               Profile::GENDER_MALE => Yii::t('app', Profile::GENDER_MALE_STRING)
               ], ['prompt' => Yii::t('app', 'Choose') . ' ' . Yii::t('app', 'Gender')]
            )->label(false)
            ?>
            <?=
            $form->field($model, 'verifyCode')->label(false)->widget(Captcha::className(), [
               'captchaAction' => 'site/captcha',
               'options' => [
                  'placeholder' => $model->getAttributeLabel('verifyCode')
               ]
            ])
            ?>
            <?= $form->field($model, 'terms')->checkbox(['checked' => true])->label(Html::a(Yii::t('app', 'Terms'), 'terms', ['target' => '_blank'])); ?>

            <div class="form-group centered_formgroup">
                <button type="submit" class="btn btn-default btn-mediabox"><?= Yii::t('app', 'Signup') ?></button>
                <br>
                <hr>
                <p class="message"><?= Yii::t('app', 'Are you have account?') ?></p>
                <?= Html::button(Yii::t('app', 'Login'), ['onclick' => "location.href='" . Url::to(['login']) . "';", 'id' => 'btn-snow', 'class' => 'btn btn-default btn-mediabox']) ?>
                <br>
                <br>
                <br>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>