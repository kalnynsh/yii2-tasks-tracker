<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?=Html::a('<span class="logo-mini">D`task admin</span><span class="logo-lg">'
        . Yii::$app->name . '</span>',
        Yii::$app->homeUrl, ['class' => 'logo']);?>

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
                        <!-- <span class="label label-success">0</span> -->
                    </a>
                    <ul class="dropdown-menu">
                         <li class="header"><!--You have not messages --></li>
                        <li></li>                        
                    </ul>
                </li>
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning"><!--10--></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header"><!--You have 10 notifications--></li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-users text-aqua"></i><!-- 5 new members joined today -->
                                    </a>
                                </li>                                
                            </ul>
                        </li>
                        <!-- <li class="footer"><a href="#">View all</a></li> -->
                    </ul>
                </li>
                <!-- Tasks: style can be found in dropdown.less -->
                <li class="dropdown tasks-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-flag-o"></i>
                        <span class="label label-danger"><!-- 1 --></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header"><!--You have 1 tasks --></li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <li><!-- Task item -->
                                    <a href="#">
                                        <h3>
                                            <!-- Design some buttons
                                            <small class="pull-right">20%</small> -->
                                        </h3>
                                        <div class="progress xs">
                                            <!-- <div class="progress-bar progress-bar-aqua" style="width: 20%"
                                                 role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                                 aria-valuemax="100">
                                                <span class="sr-only">20% Complete</span>
                                            </div> -->
                                        </div>
                                    </a>
                                </li>
                                <!-- end task item -->                                
                            </ul>
                        </li>
                        <!-- <li class="footer">
                            <a href="#">View all tasks</a>
                        </li> -->
                    </ul>
                </li>
                <!-- User Account: style can be found in dropdown.less -->

                <li class="dropdown user user-menu">
                    <?php if (Yii::$app->user->isGuest) : ?>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="/img/users/10_man.jpg" class="user-image" alt="User Image"/>
                            <span class="hidden-xs">Guest</span>
                        </a>
                    <?php else : ?>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">                        
                        <img src="/img/users/<?=$this->params['profile']['image']?>" class="user-image" alt="User Image"/>
                        <?=$this->params['profile']['fullName']?>
                    </a>
                    <?php endif; ?>
                    <ul class="dropdown-menu">
                        <?php if (Yii::$app->user->isGuest) : ?>
                            <!-- User image -->
                            <li class="user-header">
                            <img src="/img/users/10_man.jpg" class="img-circle"
                                    alt="User Image"/>
                                <p>
                                    Guest
                                    <small><?=\date('Y')?></small>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body">
                                <div class="col-xs-4 text-center">
                                    <a href="site/login">Login</a>
                                </div>
                            </li>
                        <?php else : ?>
                            <!-- User image -->
                            <li class="user-header">
                                <!-- <img src="<?=$directoryAsset?>/img/user2-160x160.jpg" class="img-circle"
                                    alt="User Image"/> -->
                                <img src="/img/users/<?=$this->params['profile']['image']?>" class="img-circle" 
                                    alt="User Image"/>
                                <p>
                                    <?=$this->params['profile']['fullName']?>                                
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body">
                                <div class="col-xs-12 text-center">                                    
                                    <?=$this->params['profile']['spec']?>                                   
                                </div>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="/admin/users-profiles/view?id=<?=$this->params['profile']['id']?>" 
                                        class="btn btn-default btn-flat">
                                        Profile
                                    </a>
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
                <!-- <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li> -->
            </ul>
        </div>
    </nav>
</header>