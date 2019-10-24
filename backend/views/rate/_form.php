<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \box\forms\rate\RateForm */
/* @var $form yii\widgets\ActiveForm */
?>
    <div class="row">
        <?php $form = ActiveForm::begin(); ?>
        <div class="col-md-6">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3>Параметры тарифа</h3>
                </div>
                <div class="box-body">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'sum')->input('number') ?>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3>Параметры тарифа</h3>
                </div>
                <div class="box-body">
                    <div class="row" id="percent-row">
                        <div class="cols">
                            <div class="col-md-7"><b>Шаг №</b></div>
                            <div class="col-md-4"><b>Процент %</b></div>
                            <?php foreach ($model->percents as $i => $percent): ?>
                                <div class="col-md-7">
                                    <?= $form->field($percent, '[' . $i . ']step')->input('number', [
                                            'placeholder' => 'Шаг',
                                            'value'=> $i+1
                                    ])->label(false) ?>
                                </div>
                                <div class="col-md-4">
                                    <?= $form->field($percent, '[' . $i . ']value')->input('number', ['placeholder' => 'Процент'])->label(false) ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="form-group">
                        <?= Html::submitButton('Создать', ['class' => 'btn btn-block btn-flat btn-success']) ?>
                    </div>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>


<?php
