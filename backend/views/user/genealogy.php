<?php
/**
 * Created by Madetec-Solution.
 * Developer: Mirkhanov Z.S.
 */

use box\entities\user\User;
use box\helpers\UserHelper;
use box\widgets\NestedSetsWidget;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $main User */
/* @var $users User[] */

$this->title = 'Генеалогия';
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="box">
        <div class="box-header">
            <h4>Ваш уровень <?= $main->step() ?></h4>
            <hr>
        </div>
        <div class="box-body">
            <div id="wrapper">
                <a href="<?= Url::to(['/user/view', 'id' => $main->id]) ?>" class="md-chip md-chip-raised"
                   data-toggle="tooltip"
                   title="<?= $main->profile->fullName ?>">
                    <div class="md-chip-icon">
                        <img src="<?= Yii::getAlias('@icons') ?><?= $main->profile->sex == 10 ? '/man.jpg' : '/woman.jpg' ?>">
                    </div>
                    <?= $main->profile->given_name ?>
                </a>
                <?= NestedSetsWidget::widget(['items' => $users]) ?>
            </div>
        </div>
    </div>

<?php

$style = <<<CSS
.md-chip {
  background: #e0e0e0;
  padding: 0 12px;
  border-radius: 32px;
  font-size: 13px;
  display: block;
  min-width: 150px;
  line-height: 20px;
  text-align: center;
  position: absolute;
  left: 0;
  top: 50%;
  margin-top: -15px;
  cursor: pointer;
   color: #353535!important;
}
.md-chip.md-chip-hover:hover {
  background: #ccc;
}

.md-chip-clickable {
  cursor: pointer;
}

.md-chip, .md-chip-icon {
  height: 32px;
  line-height: 32px;
}

.md-chip-icon {
  display: block;
  float: left;
  background: #009587;
  width: 32px;
  border-radius: 50%;
  text-align: center;
  color: white;
  margin: 0 8px 0 -12px;
}
.md-chip-icon img {
vertical-align: 0;
width: inherit;
border-radius: 50%;
height: 100%;
object-fit: cover;
}

.md-chip-remove {
  display: inline-block;
  background: #aaa;
  border: 0;
  height: 20px;
  width: 20px;
  border-radius: 50%;
  padding: 0;
  margin: 0 -4px 0 4px;
  cursor: pointer;
  font: inherit;
  line-height: 20px;
}
.md-chip-remove:after {
  color: #e0e0e0;
  content: 'x';
}
.md-chip-remove:hover {
  background: #999;
}
.md-chip-remove:active {
  background: #777;
}

.md-chips {
  padding: 12px 0;
}
.md-chips .md-chip {
  margin: 0 5px 3px 0;
}

/*.md-chip-raised {*/
  /*box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 1px 5px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2);*/
/*}*/

*,
*:before,
*:after {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}

.box-body {
  margin: 0;
  padding: 50px;
  color: #353535!important;
  font: 16px Verdana, sans-serif;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  overflow: scroll;
}

#wrapper {
  position: relative;
}

.branch {
  position: relative;
  margin-left: 210px;
}
.branch:before {
  content: "";
  width: 10px;
  border-top: 2px solid #e0e0e0;
  position: absolute;
  left: -60px;
  top: 50%;
  margin-top: 1px;
}

.entry {
  position: relative;
  min-height: 60px;
}
.entry:before {
  content: "";
  height: 100%;
  border-left: 2px solid #e0e0e0;
  position: absolute;
  left: -50px;
}
.entry:after {
  content: "";
  width: 50px;
  border-top: 2px solid #e0e0e0;
  position: absolute;
  left: -50px;
  top: 50%;
  margin-top: 1px;
}
.entry:first-child:before {
  width: 10px;
  height: 50%;
  top: 50%;
  margin-top: 2px;
  border-radius: 10px 0 0 0;
}
.entry:first-child:after {
  height: 10px;
  border-radius: 10px 0 0 0;
}
.entry:last-child:before {
  width: 10px;
  height: 50%;
  border-radius: 0 0 0 10px;
}
.entry:last-child:after {
  height: 10px;
  border-top: none;
  border-bottom: 2px solid #e0e0e0;
  border-radius: 0 0 0 10px;
  margin-top: -9px;
}
.entry.sole:before {
  display: none;
}
.entry.sole:after {
  width: 50px;
  height: 0;
  margin-top: 1px;
  border-radius: 0;
}
CSS;
$this->registerCss($style);
$script = <<<JS
$('[data-toggle="tooltip"]').tooltip();
JS;

$this->registerJs($script);
