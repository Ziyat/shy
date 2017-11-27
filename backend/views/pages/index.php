<?php

use backend\assets\ScriptsAsset;
use backend\models\Pages;
use backend\models\PagesSearch;
use common\models\Lang;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

ScriptsAsset::register($this);

/* @var $this yii\web\View */
/* @var $searchModel PagesSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = Yii::t('app', 'Pages');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="pages-index">

    <p>
        <?= Html::a(Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?=
    GridView::widget([
       'dataProvider' => $dataProvider,
       'filterModel' => $searchModel,
       'columns' => [
          ['class' => 'yii\grid\SerialColumn'],
          [
             'attribute' => 'lang_id',
//             'value' => 'lang.name',
             'filter' => Html::activeDropDownList($searchModel, 'lang_id', Lang::getLangList(), ['class' => 'form-control', 'prompt' => Yii::t('app', 'All')]),
             'contentOptions' => ['style' => 'width: 9%;'],
          ],
          'title',
          [
             'attribute' => 'parent',
             'value' => 'parents.title',
             'contentOptions' => ['style' => 'width: 9%;'],
          ],
          // [
          //     'attribute' => 'attribute_name',
          //     'value' => 'attribute_value',
          //     'filter' => Html::activeDropDownList($searchModel, 'attribute_name', ArrayHelper::map(ModelName::find()->asArray()->all(), 'ID', 'Name'),['class'=>'form-control','prompt' => 'Select Category']),
          // ],
//            'alias',
          [
             'attribute' => 'type',
             'value' => function($model = 'type') {
                if ($model->type == Pages::TYPE_ACTION) {
                   return Pages::typesList($model->type) . ': ' . Pages::actionslist($model->action);
                } elseif ($model->type == Pages::TYPE_LINK) {
                   // echo '<pre>'.print_r(Pages::find()->where(['id' => $model->crossing])->all(),true);die;
                   $pages = Pages::find()->where(['id' => $model->id])->all();
                   return Pages::typesList($model->type) . ': ' . $pages[0]['link'];
                } else
                   return Pages::typesList($model->type);
             },
             'filter' => Html::activeDropDownList($searchModel, 'type', Pages::typesList(), ['class' => 'form-control', 'prompt' => Yii::t('app', 'All')]),
          ],
          [
             'attribute' => 'position',
             // 'value' => 'position',
             // 'filter' => Html::activeDropDownList($searchModel, 'type', Pages::typesList(),['class'=>'form-control','prompt' => Yii::t('app', 'All')]),
             'contentOptions' => ['style' => 'width: 7%;'],
          ],
          [
             'class' => 'yii\grid\ActionColumn',
             'template' => '{view}&nbsp;&nbsp;&nbsp;{update}',
             'buttons' => [
                'view' => function ($url, $model, $key) {
                   return Html::a('<span class="glyphicon glyphicon-list-alt"></span>', ['pages/view', 'id' => $model->id]);
                },
                'update' => function ($url, $model, $key) {
                   return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['pages/update', 'id' => $model->id], ['options' => ['target' => '_blank']]);
                },
             ],
          ],
       ],
    ]);
    ?>
    <?php Pjax::end(); ?>

</div>
