<?php

$this->title = 'Admin panel';
$this->params['breadcrumbs'][] = Yii::$app->user->identity->username;
?>
<div class="site-index">
   <div class="row">
      <div class="col-sm-6">
         <dl class="dl-horizontal">
            <dt><?= Yii::t('app', 'ID') ?>:</dt><dd><?= Yii::$app->user->identity->id ?></dd>
            <dt><?= Yii::t('app', 'Username') ?>:</dt><dd><?= Yii::$app->user->identity->username ?></dd>
            <dt><?= Yii::t('app', 'Created At') ?>:</dt><dd><?= date('d.m.Y H:i:s', Yii::$app->user->identity->updated_at) ?></dd>
         </dl>
      </div>
   </div>
</div>
<hr>
<div class="">
    asd
</div>
