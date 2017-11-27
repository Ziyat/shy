<?php

use backend\assets\ScriptsAsset;
use backend\models\Pages;
use common\models\Lang;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

ScriptsAsset::register($this);
?>
<style type="text/css">
    .field-pages-type_action, .field-pages-type_page_alias, .field-pages-type_crossing, .field-pages-type_link, .field-pages-type_feed, .field-pages-text{
        display: none;
    }
</style>

<?php if (Yii::$app->session->hasFlash('success')): ?><div style="margin:5px 0 0 0;" class="alert alert-success"><?= Yii::$app->session->getFlash('success') ?></div><?php endif; ?>
<div class="pages-form">

    <?php
    $form = ActiveForm::begin([
                    // 'id' => $model->formName(),
                    // 'options' => ['class' => 'form-horizontal'],
    ]);
    ?>

    <div class="row">
        <div class="col-md-2">
            <?=
            $form->field($model, 'lang_id')->dropDownList(
                    ArrayHelper::map(Lang::find()->all(), 'id', 'name'), [
                'prompt' => Yii::t('app', 'Choose') . ' ' . Yii::t('app', 'Language'),
                'onchange' => '
                $.post("/pages/lang-change?id=' . '"+$(this).val(), function( data ){
                    $("select#pages-parent").html("<option value=\"0\">Без родителя</option>" + data);
                    $("select#pages-crossing").html("<option value=\"prompt\">Выберите</option>" + data);
                });'
                    ]
            )
            ?>

        </div>
        <div class="col-md-6">
            <?=
            $form->field($model, 'title', [
                'inputOptions' => [
                    'class' => 'form-control',
                    'size' => '50',
                // 'placeholder' => $model->getAttributeLabel('title')
        ]])->textInput(['maxlength' => true])
            ?>
        </div>
        <div class="col-md-4">
<?= $form->field($model, 'parent')->dropDownList([0 => Yii::t('app', 'No parent')] + ArrayHelper::map($modelFull, 'id', 'title')) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
<?= $form->field($model, 'is_public')->dropDownList([$model::STATUS_PAGE_PUBLIC => 'Опубликовать', $model::STATUS_PAGE_NOT_PUBLIC => 'Не опубликовать'], ['prompt' => '---']) ?>
        </div>
        <div class="col-md-6">
<?= $form->field($model, 'type')->dropDownList($model->typesList(), ['prompt' => Yii::t('app', 'Choose')]) ?>
        </div>
        <div class="col-md-2">
<?= $form->field($model, 'is_in_top_menu')->dropDownList([$model::STATUS_IN_TOP_MENU => 'Показать', $model::STATUS_NOT_IN_TOP_MENU => 'Не показать'], ['prompt' => '---']) ?>
        </div>
        <div class="col-md-2">
<?= $form->field($model, 'position')->dropDownList([1 => 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20], ['prompt' => Yii::t('app', 'Choose')]) ?>
        </div>
    </div>

    <?= $form->field($model, 'action')->dropDownList(Pages::actionslist(), ['prompt' => Yii::t('app', 'Choose') . ' ' . $model->getAttributeLabel('action')]) ?>
    <?= $form->field($model, 'alias')->textInput(['placeholder' => $model->getAttributeLabel('alias')]) ?>

    <?= $form->field($model, 'link')->textInput(['placeholder' => 'http://']) ?>

    <?=
    $form->field($article, 'text')->widget(CKEditor::className(), [
        'editorOptions' => ElFinder::ckeditorOptions('elfinder', [/* Some CKEditor Options */
            'language' => 'ru',
        ]),
            // 'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            // 'inline' => false, //по умолчанию false
    ]);
    ?>

    <div class="form-group">
<?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>



<?php ActiveForm::end(); ?>

</div>