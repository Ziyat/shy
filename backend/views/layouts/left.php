<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->username ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Меню', 'options' => ['class' => 'header']],
                    ['label' => 'Cтраницы', 'icon' => 'th-list', 'url' => ['/pages']],
//                    ['label' => 'Блюда', 'icon' => 'cubes', 'url' => ['/index']],
//                    ['label' => 'Блюда', 'icon' => 'cubes', 'url' => ['/slider']],
//                    ['label' => 'Блюда', 'icon' => 'cubes', 'url' => ['/articles']],
                    ['label' => 'Контакты', 'icon' => 'envelope', 'url' => ['/contacts']],
//                    ['label' => 'Блюда', 'icon' => 'cubes', 'url' => ['/services']],
                ],
            ]
        ) ?>

    </section>

</aside>
