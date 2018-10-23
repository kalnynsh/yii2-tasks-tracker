<aside class="main-sidebar">

    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <?php if (Yii::$app->user->isGuest) : ?>
                <div class="pull-left image">
                    <img src="/img/users/10_man.jpg" class="img-circle" alt="User Image"/>
                </div>
                <div class="pull-left info">
                    <p>Guest</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            <?php else : ?>
                <?php if (isset($this->params['profile'])) : ?>
                <div class="pull-left image">
                    <img src="/img/users/<?=$this->params['profile']['image']?>"
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
                        <a href="/admin/users-profiles/create?id=<?=\Yii::$app->user->getId()?>">
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

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Main navigation', 'options' => ['class' => 'header']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => \Yii::$app->user->isGuest],
                    [
                        'label' => 'Yii',
                        'icon' => 'file-code-o',
                        'url' => ['#'],
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'heartbeat', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'cog', 'url' => ['/debug'],],
                        ],
                    ],
                    [
                        'label' => 'People',
                        'icon' => 'users',
                        'url' => '#',
                        'items' => [
                            [
                                'label' => 'Users',
                                'icon' => 'user-circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'User`s List', 'icon' => 'user-o', 'url' => '/admin/users',],
                                    [
                                        'label' => 'Create User',
                                        'icon' => 'user-o',
                                        'url' => '/admin/users/create',
                                        'visible' => \Yii::$app->user->can('createUser'),
                                    ],
                                ],
                            ],
                            [
                                'label' => 'Groups',
                                'icon' => 'sitemap',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Groups List', 'icon' => 'cogs', 'url' => '/admin/groups',],
                                    [
                                        'label' => 'Create Group',
                                        'icon' => 'cog',
                                        'url' => '/admin/groups/create',
                                        'visible' => \Yii::$app->user->can('createTeam'),
                                    ],
                                ],
                            ],
                            [
                                'label' => 'Teams',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Teams List', 'icon' => 'cubes', 'url' => '/admin/teams',],
                                    [
                                        'label' => 'Create Team',
                                        'icon' => 'cubes',
                                        'url' => '/admin/teams/create',
                                        'visible' => \Yii::$app->user->can('createTeam'),
                                    ],
                                ],
                            ],
                            [
                                'label' => 'Users Teams Groups',
                                'icon' => 'star',
                                'url' => '/admin',
                                'items' => [
                                    ['label' => 'User Team Group List', 'icon' => 'star-half-o', 'url' => '/admin/user-team-group',],
                                    [
                                        'label' => 'Create Join User Team Group',
                                        'icon' => 'star-half-o',
                                        'url' => '/admin/user-team-group/create',
                                        'visible' => \Yii::$app->user->can('createTeam'),
                                    ],
                                ],
                            ],
                            [
                                'label' => 'Users profiles',
                                'icon' => 'address-book-o',
                                'url' => '/admin',
                                'items' => [
                                    ['label' => 'Users profiles List', 'icon' => 'address-card-o', 'url' => '/admin/users-profiles',],
                                    [
                                        'label' => 'Create User profile',
                                        'icon' => 'address-card-o',
                                        'url' => '/admin/users-profiles/create',
                                        'visible' => \Yii::$app->user->can('createProfile'),
                                    ],
                                ],
                            ],

                        ],
                    ],
                    [
                        'label' => 'Projects',
                        'icon' => 'globe',
                        'url' => '#',
                        'items' => [
                                ['label' => 'Projects List', 'icon' => 'circle-o', 'url' => '/admin/projects',],
                                [
                                    'label' => 'Create Project',
                                    'icon' => 'circle-o',
                                    'url' => '/admin/projects/create',
                                    'visible' => \Yii::$app->user->can('createProject'),
                                ],
                        ],
                    ],
                    [
                        'label' => 'Tasks',
                        'icon' => 'tasks',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Tasks List', 'icon' => 'suitcase', 'url' => '/admin/tasks',],
                            [
                                'label' => 'Create Task',
                                'icon' => 'suitcase',
                                'url' => '/admin/tasks/create',
                                'visible' => \Yii::$app->user->can('createTask'),
                            ],
                        ],
                    ],
                    [
                        'label' => 'Status',
                        'icon' => 'th',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Status List', 'icon' => 'circle-o', 'url' => '/admin/status',],
                            [
                                'label' => 'Create Status',
                                'icon' => 'circle-o',
                                'url' => '/admin/status/create',
                                'visible' => \Yii::$app->user->can('createProject'),
                            ],
                        ],
                    ],
                    [
                        'label' => 'Reports',
                        'icon' => 'pie-chart',
                        'url' => '/admin/reports',
                        'visible' => \Yii::$app->user->can('readProject'),
                    ],
                ],
            ]
        ); ?>

    </section>

</aside>
