<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
        <?php if (Yii::$app->user->isGuest) : ?>
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/10_man.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Guest</p>
            </div>
        <?php else : ?>
            <?php if (isset($this->params['profile'])) : ?>
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/<?=$this->params['profile']['image']?>"
                    class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>
                    <?= $this->params['profile']['fullName']; ?>
                </p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
            <?php else : ?>
                <p>
                    <a href="/profiles/create?id=<?=\Yii::$app->user->getId()?>">
                        <i class="fa fa-address-book"></i>
                        Create profile
                    </a>
                </p>
            <?php endif; ?>
        <?php endif; ?>
        </div>
        <!-- search form -->
        <!-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form> -->
        <!-- /.search form -->

        <?= \dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Menu', 'options' => ['class' => 'header']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],

                    [
                        'label' => 'Tasks',
                        'icon' => 'tasks',
                        'url' => ['/tasks/index'],
                        'visible' => Yii::$app->user->can('readTask'),
                        'items' => [
                            ['label' => 'Calendar', 'icon' => 'suitcase', 'url' => '/tasks/calendar'],
                        ],
                    ],
                    [
                        'label' => 'People',
                        'icon' => 'users',
                        'url' => ['/profiles/index'],
                        'visible' => Yii::$app->user->can('readProfile'),
                    ],

                    ['label' => 'About', 'icon' => 'globe', 'url' => ['/site/about']],
                    ['label' => 'Contact', 'icon' => 'address-book', 'url' => ['/site/contact']],
                ],
            ]
        ) ?>

    </section>

</aside>
