<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel box\searches\RateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Тарифы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box">
    <div class="box-header">
<?= Html::a('Создать тариф', ['create'], ['class' => 'btn btn-flat btn-success']) ?>

    </div>
    <div class="box-body">
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'name',
        'description',
        'sum',
        'status',
        'created_at',
        'updated_at',
        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>
    </div>
</div>
