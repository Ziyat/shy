<?php

use box\entities\user\User;
use box\helpers\RateHelper;
use box\helpers\UserHelper;
use kartik\select2\Select2;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $user box\entities\user\User */

$partners = UserHelper::getPartners($user);

$this->title = $user->profile->given_name;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-4">
        <div class="box box-widget widget-user">
            <div class="widget-user-header bg-black"
                 style="background: url('/img/widgetsBg/1.jpg') center center; background-size: cover;">
                <h3 class="widget-user-username"><?= $user->profile->fullName ?></h3>
                <h5 class="widget-user-desc"><?= $user->role ?></h5>
            </div>
            <div class="widget-user-image">
                <img class="img-circle" src="<?= UserHelper::getGenderIcon($user->profile->sex) ?>" alt="User Avatar">
            </div>
            <div class="box-footer">
                <div class="row">
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                            <h5 class="description-header"><?= $partners->lft . ' | ' . $partners->rgt ?></h5>
                            <span class="description-text">партнёры</span>
                        </div>

                    </div>

                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                            <h5 class="description-header"><?= $user->balance() ?></h5>
                            <span class="description-text">баланс</span>
                        </div>

                    </div>

                    <div class="col-sm-4">
                        <div class="description-block">
                            <h5 class="description-header"><?= $user->step() ?></h5>
                            <span class="description-text">шаг</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-body no-padding">
                <?= DetailView::widget([
                    'model' => $user,
                    'attributes' => [
                        'id',
                        'username',
                        'created_at:datetime',
                        'updated_at:datetime',
                    ],
                ]) ?>
            </div>
            <div class="box-footer no-padding">
                <?= Html::a("<i class='fa fa-file-o'></i> Добавить документы", ['documents', 'id' => $user->id], ['class' => 'btn center-block btn-flat btn-primary']) ?>
                <?= Html::a("<i class='fa fa-pencil'></i>  Редактировать", ['update', 'id' => $user->id], ['class' => 'btn center-block btn-flat btn-info']) ?>
                <?php if (!$user->isFullTree() && !$user->isAdmin()) : ?>
                    <?= Html::a("<i class='fa fa-trash'></i> Удалить", ['delete', 'id' => $user->id], [
                        'class' => 'btn center-block btn-xs btn-flat btn-danger',
                        'data' => [
                            'confirm' => 'Вы уверены, что хотите удалить этого пользователя?',
                            'method' => 'post',
                        ],
                    ]) ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="box">
            <?= DetailView::widget([
                'model' => $user->profile,
                'attributes' => [
                    'fullName',
                    'date_of_birth:date',
                    'date_of_expiry:date',
                    'date_of_issue:date',
                    'place_of_birth',
                    'passport_number',
                    'gender',
                    'nationality',
                    [
                        'attribute' => 'phone_first',
                        'value' => UserHelper::getPhoneLink($user->profile->phone_first),
                        'format' => 'html'
                    ],
                    [
                        'attribute' => 'phone_second',
                        'value' => UserHelper::getPhoneLink($user->profile->phone_second),
                        'format' => 'html'
                    ],
                    'address_first',
                    'address_second',
                ],
            ]) ?>
        </div>
    </div>

    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h4>Операций над пользователем</h4>
            </div>
            <div class="box-body">
                <?php ActiveForm::begin([
                    'method' => 'get',
                    'action' => Url::to(['user/change-parent']),
                ]); ?>
                <?= Html::hiddenInput('from', $user->id) ?>
                <div class="row">
                    <div class="col-md-2">
                        <b>Изменение местами</b>
                    </div>
                    <div class="col-md-5"> <?= Select2::widget([
                            'name' => 'to',
                            'bsVersion' => '3.x',
                            'theme' => Select2::THEME_BOOTSTRAP,
                            'options' => ['placeholder' => 'Выберите'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                            'data' => ArrayHelper::map(
                                User::find()
                                    ->where(['and', ['!=', 'id', $user->id], ['>', 'depth', 0]])
                                    ->all(), 'id', function ($m) {
                                return $m->profile->fullName;
                            }),
                        ]) ?></div>
                    <div class="col-md-5">
                        <?= Html::submitButton(
                            'Поменять местами',
                            ['class' => 'btn btn-flat btn-block btn-success'])
                        ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h4>Операций над тарифом <small>Текущий тариф ( <?= $user->rate->name ?? 'не указано' ?> )</small></h4>
            </div>
            <div class="box-body">
                <?php $form = ActiveForm::begin([
                    'method' => 'get',
                    'action' => Url::to(['user/set-rate']),
                ]); ?>
                <?= Html::hiddenInput('id', $user->id) ?>
                <div class="row">
                    <div class="col-md-2">
                        <b>Установить тариф</b>
                    </div>
                    <div class="col-md-5"> <?= Select2::widget(array(
                            'name' => 'rate_id',
                            'bsVersion' => '3.x',
                            'theme' => Select2::THEME_BOOTSTRAP,
                            'options' => array('placeholder' => 'Выберите'),
                            'pluginOptions' => array(
                                'allowClear' => true
                            ),
                            'data' => RateHelper::getRateList(),
                        )) ?></div>
                    <div class="col-md-5">
                        <?= Html::submitButton(
                            'Установить',
                            ['class' => 'btn btn-flat btn-block btn-success'])
                        ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
