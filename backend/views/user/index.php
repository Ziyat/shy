<?php

use box\entities\user\User;
use box\helpers\UserHelper;
use kartik\date\DatePicker;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel box\searches\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box">
    <div class="box-header">
        <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <div class="box-body">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'options' => [
                'class' => 'table-responsive'
            ],
            'tableOptions' => [
                'class' => 'table table-striped table-bordered table-condenced',
                'style' => 'white-space: nowrap;'
            ],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'fullName',
                    'value' => function (User $user) use ($searchModel) {
                        $indent = ($user->depth > $searchModel->main->depth ? str_repeat('<i class="text-danger">-</i>', $user->depth - (1 + $searchModel->main->depth)) . ' ' : '');
                        return $indent . Html::a(Html::encode($user->profile->fullName), Url::to(['view', 'id' => $user->id]));
                    },
                    'format' => 'raw',

                ],
                'username',
                [
                    'attribute' => 'profile.phone_first',
                    'value' => function (User $user) {
                        return UserHelper::getPhoneLink($user->profile->phone_first);
                    },
                    'format' => 'html',
                ],
                [
                    'attribute' => 'created_at',
                    'format' => 'datetime',
                    'filter' => DatePicker::widget([
                        'attribute' => 'created_at',
                        'model' => $searchModel,
                        'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'dd-mm-yyyy'
                        ]
                    ])
                ],
//                [
//                    'label' => 'Уровень',
//                    'value' => function (User $user) {
//                        return UserHelper::badge($user->currentStep());
//                    },
//                    'format' => 'html',
//                    'contentOptions' => ['class' => 'text-center']
//                ],
//                [
//                    'label' => 'Л | П',
//                    'value' => function (User $user) {
//                        $partners = UserHelper::getPartners($user);
//                        return UserHelper::badge("$partners->lft | $partners->rgt");
//                    },
//                    'format' => 'html',
//                    'contentOptions' => ['class' => 'text-center']
//                ],
                [
                    'label' => 'Баланс - so`m',
                    'value' => function (User $user) {
                        return Html::tag('b', $user->balance());
                    },
                    'format' => 'html'
                ],
                [
                    'label' => 'Тариф',
                    'value' => function (User $user) {
                        return UserHelper::badge($user->rate ? $user->rate->name : null, 'default');
                    },
                    'format' => 'html',
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'options' => ['width' => '70']
                ],
            ],
        ]); ?>
    </div>
</div>
