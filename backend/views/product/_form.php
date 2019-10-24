<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model box\entities\product\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'desc')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'img')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'in_price')->textInput() ?>

        <?= $form->field($model, 'out_price')->textInput() ?>

        <?= $form->field($model, 'category_id')->textInput() ?>

        <?= $form->field($model, 'created_at')->textInput() ?>

        <?= $form->field($model, 'updated_at')->textInput() ?>

    </div>
    <div class="box-footer">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
