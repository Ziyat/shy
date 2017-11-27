<?php

use backend\assets\AppAsset;
use backend\models\user\User;
use backend\models\UserPrice;
use common\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <?= Html::csrfMetaTags() ?>
        <script src="/js/resumable.js"></script>
        <title><?= Html::encode($this->title) ?></title>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="/dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="/dist/css/skins/_all-skins.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="/plugins/iCheck/flat/blue.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <?php $this->head() ?>
    </head>
    <body class="hold-transition skin-purple sidebar-mini">
        <?php $this->beginBody() ?>
        <div class="wrapper">
            <header class="main-header">
                <!-- Logo -->
                <a href="<?= Yii::$app->homeUrl ?>" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>DB</b></span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>DB</b></span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>

                    <?php if (!Yii::$app->user->isGuest) { ?>
                       <div class="navbar-custom-menu">
                           <ul class="nav navbar-nav">
                               <!-- User Account: style can be found in dropdown.less -->
                               <li class="dropdown user user-menu">
                                   <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                       <img src="/dist/img/blank-avatar.png" class="user-image" alt="User Image">
                                       <span class="hidden-xs"><?= Yii::$app->user->identity->username ?></span>
                                   </a>
                                   <ul class="dropdown-menu">
                                       <!-- User image -->
                                       <li class="user-header">
                                           <img src="/dist/img/blank-avatar.png" class="img-circle" alt="User Image">

                                           <p>
                                               <?= Yii::$app->user->identity->username ?> - <?php //= Yii::$app->user->identity->role ?>
                                               <small><?= Yii::t('app', 'Updated At') ?>: <?= date('d.m.Y H:i:s', Yii::$app->user->identity->updated_at) ?></small>
                                           </p>
                                       </li>
                                       <!-- Menu Footer-->
                                       <li class="user-footer">
                                           <div class="pull-right">
                                               <!--<div class="pull-left"><a href="#" class="btn btn-default btn-flat">Profile</a></div>-->
                                               <div class="pull-right">
                                                   <?= Html::beginForm(['/site/logout'], 'post') . Html::submitButton(Yii::t('app', 'Logout'), ['class' => 'btn btn-default btn-flat']) . Html::endForm() ?>
                                               </div>
                                           </div>
                                       </li>
                                   </ul>
                               </li>
                           </ul>
                       </div>
                   </nav>
                <?php } ?>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <?php if (!Yii::$app->user->isGuest) { ?>
               <aside class="main-sidebar">
                   <!-- sidebar: style can be found in sidebar.less -->
                   <section class="sidebar">
                       <!-- Sidebar user panel -->
                       <div class="user-panel">
                           <div class="pull-left image">
                               <img src="/dist/img/blank-avatar.png" class="img-circle" alt="User Image">
                           </div>
                           <div class="pull-left info">
                               <p><?= Yii::$app->user->identity->username ?></p>
                               <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                           </div>
                       </div>
                       <!-- sidebar menu: : style can be found in sidebar.less -->
                       <ul class="sidebar-menu">
                           <li class="header"><span class="pull-right-container content-header"><a href="<?= Url::to('/user/create-user') ?>" class="btn btn-success btn-block"><i class="fa fa-user-plus"></i> <?= Yii::t('app', 'Create') ?></a></span></li>
                           <li>
                               <a href="<?= Url::to('/site') ?>"><i class="fa fa-home"></i> <span>Bosh sahifa</span></a>
                           </li>
                           <li>
                               <a href="<?= Url::to(['/user/update', 'id' => Yii::$app->user->id]) ?>"><i class="fa fa-user"></i> <span>Profil</span></a>
                           </li>
                           <li>
                               <a href="<?= Url::to('/user') ?>">
                                   <i class="fa fa-users"></i> <span><?= Yii::t('app', 'Users') ?></span>
                                   <span class="pull-right-container"><small class="label pull-right bg-purple"><?= User::find()->count() ?></small></span>
                               </a>
                           </li>
                       </ul>
                   </section>
                   <!-- /.sidebar -->
               </aside>
            <?php } ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1><?php
//                        echo '<pre>' . print_r($this->params, true);die;
                        $headerArray = isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [];
                        if (count($headerArray) == 1) {
                           echo $headerArray[0];
                        } else {
                           $a = array_shift($headerArray);
                           echo Html::a($a['label'], $a['url']) . '<small>' . array_pop($headerArray) . '</small>';
                        }
                        ?>
                    </h1>
                    <?=
                    Breadcrumbs::widget([
                       'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ])
                    ?>
                </section>

                <!-- Main content -->
                <section class="content">
                    <?= Alert::widget() ?>
                    <?= $content ?>
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            <!--<footer class="main-footer">-->
            <!--<div class="pull-left hidden-xs"><b>Version</b> 1.0.0</div>-->
            <!--<div class="pull-right hidden-xs"><strong>Copyright &copy; 2016-<?= date('Y') ?> <a href="http://pragmauz.uz" target="_blank">pragmauz.uz</a>.</strong> Barcha huquqlar himoyalangan. | <b><?= Yii::powered() ?></b></div><br>-->
            <!--</footer>-->

            <!-- Control Sidebar -->

            <!-- Add the sidebar's background. This div must be placed
                 immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>
        <!-- ./wrapper -->

        <?php $this->endBody() ?>
        <script>
           $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Slimscroll -->
        <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="plugins/fastclick/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="/dist/js/app.min.js"></script>
    </body>
</html>
<?php $this->endPage() ?>
