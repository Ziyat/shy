<?php

/* @var $this yii\web\View */
/* @var $model \box\forms\rate\RateForm */

$this->title = 'Создать тариф';
$this->params['breadcrumbs'][] = ['label' => 'Тарифы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_form', [
    'model' => $model,
]) ?>
