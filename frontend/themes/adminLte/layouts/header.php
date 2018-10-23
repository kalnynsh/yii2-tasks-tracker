<?php
use yii\helpers\Html;
use Yii;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?=Html::a(
        '<span class="logo-mini">D`task</span><span class="logo-lg">'
        . Yii::$app->name . '</span>',
        Yii::$app->homeUrl,
        ['class' => 'logo']
    ); ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-envelope-o"></i>
                        <span class="label label-success"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li></li>
                    </ul>
                </li>       
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header"></li>
                        <li></li>                        
                    </ul>
                </li>
                <!-- Tasks: style can be found in dropdown.less -->
                <li class="dropdown tasks-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-flag-o"></i>
                        <span class="label label-danger"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header"></li>
                            <ul class="menu">
                                <li></li>                        
                            </ul>
                        </li>
                    </ul>
                </li>
                <!-- User Account: style can be found in dropdown.less -->

                <li class="dropdown user user-menu">
                <?php if (Yii::$app->user->isGuest) : ?>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?=$directoryAsset?>/10_man.jpg" class="user-image" alt="User Image"/>
                        <span class="hidden-xs">Guest</span>
                    </a>
                <?php else : ?>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?=$directoryAsset?>/<?=$this->params['profile']['image']?>"
                            class="user-image" alt="User Image"/>
                        <span class="hidden-xs">
                            <?=$this->params['profile']['fullName']?>
                        </span>
                    </a>
                <?php endif; ?>
                    <ul class="dropdown-menu">
                        <?php if (Yii::$app->user->isGuest) : ?>
                            <!-- User image -->
                            <li class="user-header">
                            <img src="<?=$directoryAsset?>/10_man.jpg" class="img-circle"
                                    alt="User Image"/>
                                <p>
                                    Guest
                                    <small><?=\date('Y')?></small>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body">
                                <div class="col-xs-4 text-center">
                                    <a href="site/signup">Signup</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="site/login">Login</a>
                                </div>
                            </li>
                        <?php else : ?>
                            <!-- User image -->
                            <?php if (isset($this->params['profile'])) : ?>
                            <li class="user-header">
                            <img src="<?=$directoryAsset?>/<?=$this->params['profile']['image']?>" class="img-circle"
                                    alt="User Image"/>
                                <p>
                                    <?=$this->params['profile']['fullName']?>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body">
                                <div class="col-xs-12 text-center">
                                    <a href="/profiles/view?id=<?=$this->params['profile']['id']?>">
                                        <?=$this->params['profile']['spec']?>
                                    </a>
                                </div>
                            </li>
                            <?php else : ?>
                            <li class="user-header">
                            <img src="<?=$directoryAsset?>/09_man.jpg" class="img-circle"
                                    alt="User Image"/>
                            </li>
                            <?php endif; ?>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="/profiles/view?id=<?=$this->params['profile']['id']?>"
                                        class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <?=Html::a(
                                        'Sign out',
                                        ['site/logout'],
                                        ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                    )?>
                                </div>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>

                <!-- User Account: style can be found in dropdown.less -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
