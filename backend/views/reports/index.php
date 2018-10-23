<?php

use Yii;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\widgets\ListView;
use insolita\wgadminlte\LteBox;
use insolita\wgadminlte\LteConst;
use common\components\helpers\HtmlListHelper;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

echo $this->render('_profile', ['profile' => $profile]);

$this->title = Yii::t('app', 'Reports');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-index">

    <div class="col col-md-3">
        <?php LteBox::begin([
            'type' => LteConst::TYPE_INFO,
            'isSolid' => true,
            'boxTools' =>
            '<button class="btn btn-success btn-xs create_button" >
                <i class="fa fa-cubes"></i>
                Info
            </button>',
            'tooltip' => 'View Projects',
            'title' => 'Projects',
            'footer' => 'Total <span class="label label-info">'
                . $projectsCount
                . '</span> active projects',
        ]); ?>

        <?php
            echo ListView::widget([
                'dataProvider' => $dataProviderProjects,
                'itemView' => '_project',
            ]); ?> 

        <?php LteBox::end();?>
    </div>

    <div class="col col-md-3">
        <?php LteBox::begin([
            'type' => LteConst::TYPE_SUCCESS,
            'isSolid' => true,
            'boxTools' =>
            '<button class="btn btn-success btn-xs create_button" >
                <i class="fa fa-cube"></i>
                Info
            </button>',
            'tooltip' => 'View Tasks',
            'title' => 'Active Tasks',
            'footer' => 'Total <span class="label label-success">'
                . $activeTasksCount
                . '</span> active tasks',
        ]); ?>

        <?php
            echo ListView::widget([
                'dataProvider' => $dataProviderTasks,
                'itemView' => '_task',
            ]); ?> 

        <?php LteBox::end();?>
    </div>

    <div class="col col-md-3">
        <?php LteBox::begin([
            'type' => LteConst::TYPE_DEFAULT,
            'isSolid' => true,
            'boxTools' =>
            '<button class="btn btn-primary btn-xs create_button" >
                <i class="fa fa-cube"></i>
                Info
            </button>',
            'tooltip' => 'View done Tasks',
            'title' => 'Done Tasks',
            'footer' => 'Total <span class="label label-primary">'
                . $doneTasksCount
                . '</span> done tasks on current week',
        ]); ?>

        <?php
            echo ListView::widget([
                'dataProvider' => $dataProviderDoneTasks,
                'itemView' => '_taskDone',
            ]); ?> 

        <?php LteBox::end();?>
    </div>

    <div class="col col-md-3">
        <?php LteBox::begin([
            'type' => LteConst::TYPE_WARNING,
            'isSolid' => true,
            'boxTools' =>
            '<button class="btn btn-danger btn-xs create_button" >
                <i class="fa fa-cube"></i>
                Info
            </button>',
            'tooltip' => 'View overdue Tasks',
            'title' => 'Overdue Tasks',
            'footer' => 'Total <span class="label label-danger">'
                . $overdueTasksCount
                . '</span> overdue tasks',
        ]); ?>

        <?php
            echo ListView::widget([
                'dataProvider' => $dataProviderOverdueTask,
                'itemView' => '_taskOverdue',
            ]); ?> 

        <?php LteBox::end();?>
    </div>

</div>
