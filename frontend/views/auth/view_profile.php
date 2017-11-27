<?php

use common\models\Src;
use yii\helpers\Url;
?>
<div class="container">

   <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2 col-lg-offset-2 col-lg-8 toppad" >


         <div class="panel panel-info account_mediabox">
            <div class="panel-heading">
              <h3 class="panel-title">Аккаунт</h3>
            </div>
            <div class="panel-body">
               <div class="row">
                  <div class="col-md-3 col-lg-3 ">
                     <img alt="User Pic" src="<?= Src::imgSrc($model2, 'thumb', 120) ?>" class="img-responsive" style="width: 100%; height: auto;">
                     <h3 class="panel-title usrname"><?= $model->username ?></h3>
                  </div>

                  <div class=" col-md-9 col-lg-9">
                     <table class="table table-user-information">
                        <tbody>
                        <h3 class="no-margin">Информация об аккаунте</h3>
                           <tr>
                              <td>Вы:</td>
                              <td>Пользователь сайта</td>
                           </tr>
                           <tr>
                              <td>Логин</td>
                              <td><?= $model->username ?></a></td>
                           </tr>
                           <tr>
                              <td>Дата рождение</td>
                              <td><?= date("d", $model->profile->btime) . " " . Yii::$app->formatter->asDate($model->profile->btime, 'MMMM') . ", " . date("Y", $model->profile->btime) ?>г</td>
                           </tr>

                           <tr>
                              <td>Пол</td>
                              <td><?= ($model->profile->gender) ? 'Мужчина' : 'Женщина'; ?></td>
                           </tr>
                           <tr>
                              <td>Почта</td>
                              <td><a href="mailto:info@support.com"><?= $model->email ?></a></td>
                           </tr>
         <!--                   <tr>
                             <td>Телефон номер:</td>
                             <td>+998 94 663-9662(Мобильный)
                             </td>
                           </tr> -->
                           <tr>
                              <td>Страна</td>
                              <td>Узбекистан</td>
                           </tr>

                           </tr>

                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
            <div class="panel-footer">
                <a data-original-title="feedback" class="btn btn-default btn-mediabox_default" type="button"  data-toggle="modal" data-target="#myModall"><i class="glyphicon glyphicon-envelope"></i>&nbsp;Обратный связь</a>
               <span class="pull-right">
                  <a href="<?= Url::to('/profile/edit') ?>" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-default btn-mediabox_default"><i class="glyphicon glyphicon-edit"></i>&nbsp;Редоктировать аккаунт</a>
                  <a data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-default btn-mediabox"><i class="glyphicon glyphicon-remove"></i>&nbsp;Удалить аккаунт</a>

               </span>
            </div>

         </div>
      </div>
   </div>




</div> <!-- ./container -->

