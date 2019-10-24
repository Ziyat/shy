<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model box\forms\user\ProfileForm */

$this->title = 'Редактирование: ' . $model->surname . ' ' . $model->given_name;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->surname . ' ' . $model->given_name, 'url' => ['view', 'id' => $user->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<?php $form = ActiveForm::begin(); ?>
<div class="col-md-8">
    <div class="box">
        <div class="box-header">
            <h4>
                <ins><b>Паспортные данные</b></ins>
            </h4>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'surname')->textInput() ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'given_name')->textInput() ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'father_name')->textInput() ?>
                </div>

                <div class="col-md-6">
                    <?= $form->field($model, 'date_of_birth')->textInput() ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'sex')->dropDownList($model->getSexList(), [
                        'prompt' => 'Выберите ' . $model->getAttributeLabel('sex')
                    ]) ?>
                </div>

                <div class="col-md-4">
                    <?= $form->field($model, 'nationality')->textInput() ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'place_of_birth')->textInput() ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'passport_number')->textInput() ?>
                </div>

                <div class="col-md-6">
                    <?= $form->field($model, 'date_of_issue')->textInput() ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'date_of_expiry')->textInput() ?>
                </div>
            </div>
            <div class="form-group">
                <?= Html::submitButton('Редактировать', ['class' => 'btn btn-flat btn-block btn-success']) ?>
            </div>
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
            <?= $form->field($model, 'phone_first')->widget(MaskedInput::class, [
                'mask' => '99 999-99-99',
                'options' => ['placeholder' => '99 886-69-96']
            ]) ?>
            <?= $form->field($model, 'phone_second')->widget(MaskedInput::class, [
                'mask' => '99 999-99-99',
                'options' => ['placeholder' => '99 886-69-96']
            ]) ?>
            <?= $form->field($model, 'address_first')->textInput(['placeholder' => 'г. Ташкент, р-н Мирабад...']) ?>
            <?= $form->field($model, 'address_second')->textInput(['placeholder' => 'г. Ташкент, р-н Мирабад...']) ?>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>
