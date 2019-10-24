<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= $user->profile->getFullName() ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <!--        <form action="#" method="get" class="sidebar-form">-->
        <!--            <div class="input-group">-->
        <!--                <input type="text" name="q" class="form-control" placeholder="Search..."/>-->
        <!--              <span class="input-group-btn">-->
        <!--                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>-->
        <!--                </button>-->
        <!--              </span>-->
        <!--            </div>-->
        <!--        </form>-->
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                'items' => [
                    ['label' => 'Меню', 'options' => ['class' => 'header']],
                    ['label' => 'Тарифы', 'icon' => 'sort-amount-asc', 'url' => ['/rate']],
                    ['label' => 'Пользователи', 'icon' => 'users', 'url' => ['/user']],
                    ['label' => 'Генеалогия', 'icon' => 'sitemap', 'url' => ['/user/genealogy']],
                    [
                        'label' => 'Управление товарами',
                        'icon' => 'list-ol',
                        'items' => [
                            ['label' => 'Категорий', 'icon' => 'sliders', 'url' => ['/category']],
                            ['label' => 'Товары', 'icon' => 'tags', 'url' => ['/product']],
                        ]
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
