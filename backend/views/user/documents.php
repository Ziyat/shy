<?php
/* @var $this yii\web\View */
/* @var $document PhotosForm */
/* @var $user User */
use box\entities\user\User;
use box\forms\user\PhotosForm;
use kartik\file\FileInput;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Документы';
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="row">

    <div class="col-md-12">
        <div class="box" id="photos">
            <div class="box-header with-border">Фотографии</div>
            <div class="box-body">
                <div class="row">
                    <?php foreach ($user->photos as $photo): ?>
                        <div class="col-md-2 col-xs-3" style="text-align: center">
                            <div class="btn-group">
                                <?= Html::a('<span class="glyphicon glyphicon-arrow-left"></span>', ['move-photo-up', 'id' => $user->id, 'photo_id' => $photo->id], [
                                    'class' => 'btn btn-flat btn-sm btn-default',
                                    'data-method' => 'post',
                                ]); ?>
                                <?= Html::a('<span class="glyphicon glyphicon-remove"></span>', ['delete-photo', 'id' => $user->id, 'photo_id' => $photo->id], [
                                    'class' => 'btn btn-flat btn-sm btn-default',
                                    'data-method' => 'post',
                                    'data-confirm' => 'Remove photo?',
                                ]); ?>
                                <?= Html::a('<span class="glyphicon glyphicon-arrow-right"></span>', ['move-photo-down', 'id' => $user->id, 'photo_id' => $photo->id], [
                                    'class' => 'btn btn-flat btn-sm btn-default',
                                    'data-method' => 'post',
                                ]); ?>
                            </div>
                            <div>
                                <?= Html::a(
                                    Html::img($photo->getThumbFileUrl('file', 'thumb')),
                                    $photo->getUploadedFileUrl('file'),
                                    ['class' => 'thumbnail', 'target' => '_blank']
                                ) ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php $form = ActiveForm::begin([
                    'options' => ['enctype' => 'multipart/form-data'],
                ]); ?>
                <?= $form->field($document, 'files[]')
                    ->widget(FileInput::class, [
                        'options' => [
                            'accept' => 'image/*',
                            'multiple' => true
                        ]
                    ])->label(false) ?>
                <div class="form-group">
                    <?= Html::submitButton(Html::tag("i", null,['class' => 'fa fa-upload']) . " Загрузить", ['class' => 'btn btn-flat btn-success']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
