<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $searchModel backend\models\user\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <?=
    GridView::widget([
       'dataProvider' => $dataProvider,
       'filterModel' => $searchModel,
       'columns' => [
          ['class' => 'yii\grid\SerialColumn'],
          [
             'class' => 'yii\grid\ActionColumn',
             'template' => '{view}&nbsp;&nbsp;&nbsp;{update}&nbsp;&nbsp;&nbsp;{give-water}<br>{manage-type}&nbsp;&nbsp;&nbsp;{edit-balans}',
             'buttons' => [
                'view' => function ($url, $model, $key) {
                   return Html::a('<span class="glyphicon glyphicon-list-alt"></span>', ['user/view', 'id' => $model->id]);
                },
                'update' => function ($url, $model, $key) {
                   return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['user/update', 'id' => $model->id], ['options' => ['target' => '_blank']]);
                },
             ],
          ],
          'username',
          'created_at:datetime',
//          'updated_at:datetime',
       ],
    ]);
    ?>

</div>
