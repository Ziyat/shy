<?php

use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model box\forms\user\UserCreateForm */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Дабвление пользователя';
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="row">
    <?php $form = ActiveForm::begin(); ?>
    <div class="col-md-8">
        <div class="box">
            <div class="box-header">
                <h4>
                    <ins><b>Паспортные данные</b></ins>
                </h4>
            </div>
            <div class="box-body">
                <?= $form->field($model->profile, 'surname')->textInput([
                    'placeholder' => $model->profile->getAttributeLabel('surname')
                ])->label(false) ?>

                <?= $form->field($model->profile, 'given_name')->textInput([
                    'placeholder' => $model->profile->getAttributeLabel('given_name')
                ])->label(false) ?>

                <?= $form->field($model->profile, 'father_name')->textInput([
                    'placeholder' => $model->profile->getAttributeLabel('father_name')
                ])->label(false) ?>

                <?= $form->field($model->profile, 'date_of_birth')
                    ->label(false)
                    ->widget(DatePicker::class, [
                        'options' => ['placeholder' => $model->profile->getAttributeLabel('date_of_birth')],
                        'type' => DatePicker::TYPE_INPUT,
                        'pluginOptions' => [
                            'format' => 'dd-mm-yyyy',
                            'todayHighlight' => true
                        ]
                    ]) ?>
                <?= $form->field($model->profile, 'sex')->dropDownList($model->profile->getSexList(), [
                    'prompt' => 'Выберите ' . $model->profile->getAttributeLabel('sex')
                ])->label(false) ?>

                <?= $form->field($model->profile, 'nationality')->textInput([
                    'placeholder' => $model->profile->getAttributeLabel('nationality')
                ])->label(false) ?>

                <?= $form->field($model->profile, 'place_of_birth')->textInput([
                    'placeholder' => $model->profile->getAttributeLabel('place_of_birth')
                ])->label(false) ?>

                <?= $form->field($model->profile, 'passport_number')->textInput([
                    'placeholder' => $model->profile->getAttributeLabel('passport_number')
                ])->label(false) ?>

                <?= $form->field($model->profile, 'date_of_issue')
                    ->label(false)
                    ->widget(DatePicker::class, [
                        'options' => ['placeholder' => $model->profile->getAttributeLabel('date_of_issue')],
                        'type' => DatePicker::TYPE_INPUT,
                        'pluginOptions' => [
                            'format' => 'dd-mm-yyyy',
                            'todayHighlight' => true
                        ]
                    ]) ?>

                <?= $form->field($model->profile, 'date_of_expiry')
                    ->label(false)
                    ->widget(DatePicker::class, [
                        'options' => ['placeholder' => $model->profile->getAttributeLabel('date_of_expiry')],
                        'type' => DatePicker::TYPE_INPUT,
                        'pluginOptions' => [
                            'format' => 'dd-mm-yyyy',
                            'todayHighlight' => true
                        ]
                    ]) ?>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="box">
            <div class="box-header">
                <h4>
                    <ins><b>Адреса и телефоны</b></ins>
                </h4>
            </div>
            <div class="box-body">
                <?= $form->field($model->profile, 'phone_first')->widget(MaskedInput::class, [
                    'mask' => '99 999-99-99',
                    'options' => ['placeholder' => '99 886-69-96']
                ]) ?>
                <?= $form->field($model->profile, 'phone_second')->widget(MaskedInput::class, [
                    'mask' => '99 999-99-99',
                    'options' => ['placeholder' => '99 886-69-96']
                ]) ?>
                <?= $form->field($model->profile, 'address_first')->textInput(['placeholder' => 'г. Ташкент, р-н Мирабад...']) ?>
                <?= $form->field($model->profile, 'address_second')->textInput(['placeholder' => 'г. Ташкент, р-н Мирабад...']) ?>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="box">
            <div class="box-header">
                <h4>
                    <ins><b>Пользовательские данные</b></ins>
                </h4>
            </div>
            <div class="box-body">
                <?= $form->field($model, 'username')->textInput() ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'status')->dropDownList($model->getStatusList()) ?>
                <?= $form->field($model, 'parent_id')->widget(Select2::class, [
                    'bsVersion' => '3.x',
                    'data' => $model->getUsersList(),
                    'options' => ['placeholder' => 'Выберите спонсора'],
                    'theme' => Select2::THEME_BOOTSTRAP,
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-flat btn-block btn-success']) ?>
                </div>

            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
