<?php

/* @var $this yii\web\View */
/* @var $model box\entities\rate\Rate */

$this->title = 'Обновить тариф: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Тарифы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>

<?= $this->render('_form', [
    'model' => $model,
]) ?>
