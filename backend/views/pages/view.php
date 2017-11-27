<?php

use backend\models\Pages;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model Pages */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


    $alias = $model->alias;


if ($model->type == Pages::TYPE_ACTION) {
    $type = Pages::typesList($model->type) . ': ' . Pages::actionslist($model->action);
    $resultByType = "action";
    $alias = $model->action;
} elseif ($model->type == Pages::TYPE_CROSSING) {
    $pages = Pages::find()->where(['id' => $model->crossing])->all();
    $type = Pages::typesList($model->type) . ': ' . $pages[0]['title'];
    $resultByType = "crossing";
    $alias = "???must repair";
} elseif ($model->type == Pages::TYPE_LINK) {
// echo '<pre>'.print_r(Pages::find()->where(['id' => $model->crossing])->all(),true);die;
    $pages = Pages::find()->where(['id' => $model->id])->all();
    $type = Pages::typesList($model->type) . ': ' . $pages[0]['link'];
    $resultByType = "link";
    $alias = $model->link;
} else {
    $type = Pages::typesList($model->type);
    $resultByType = "text:html";
}
?>
<div class="pages-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'parents.title',
                'label' => Yii::t('app', 'Parent'),
            // 'format' => 'text',
            ],
            [
                'attribute' => 'lang.name',
                'label' => Yii::t('app', 'Language'),
            // 'format' => 'text',
            ],
            'position',
            'is_public:boolean',
            'is_in_top_menu:boolean',
            [
                'attribute' => 'created_at',
                'label' => Yii::t('app', 'Created at'),
                'format' => 'datetime',
            ],
            [
                'attribute' => 'updated_at',
                'label' => Yii::t('app', 'Updated at'),
                'format' => 'datetime',
            ],
            [
                'attribute' => 'type',
                'value' => $type,
                'filter' => Html::activeDropDownList($searchModel, 'type', Pages::typesList(), ['class' => 'form-control', 'prompt' => Yii::t('app', 'All')]),
            ],
            'title',
            [
                'attribute' => 'alias',
                'value' => $alias,
            ],
            $resultByType,
        ],
    ])
    ?>
    <p>
        <?=
        Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ])
        ?>
    </p>

</div>
