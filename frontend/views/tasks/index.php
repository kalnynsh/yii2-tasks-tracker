<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\models\task\TaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tasks';
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('_profile', ['profile' => $profile]);
?>
<div class="task-index">

    <h1><?=Html::encode($this->title);?></h1>
    <div class="row">
        <div class="col-md-6">
            <?php // echo $this->render('_search', ['model' => $searchModel]);?>
        </div>
    </div>

    <?= GridView::widget(
        [
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'id',
                'title:text',
                'start:date',
                'deadline:date',
                'end:date',
                'description:ntext',
                'assignee_id',
                'teamlead_id',
                [
                    'label' => 'Status',
                    'content' => function ($model, $key, $index, $column) {
                          return $model->getStatus();
                    },
                    'format' => 'text',
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => 'Actions',
                    'template' => '{view}{add-comment}',
                    'buttons' => [
                        'add-comment' => function ($url, $model, $key) {
                            return Html::a(
                                '<span class="glyphicon glyphicon-book"></span>',
                                [
                                    'add-comment',
                                    'task_id' => $model->id,
                                ]
                            );
                        },
                    ],
                    'visibleButtons' => [
                        'view' => \Yii::$app->user->can('readTask'),
                        'add-comment' => \Yii::$app->user->can('readTask'),
                    ],
                ],
            ],
        ]
    ); ?>
</div>
