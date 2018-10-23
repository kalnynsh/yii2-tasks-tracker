<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

echo $this->render('_profile', ['profile' => $profile]);

$this->title = Yii::t('app', 'Tasks');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index">
    <?php Pjax::begin(); ?>

    <?php if (\Yii::$app->user->can('createTask')) : ?>
        <p>
            <?= Html::a(Yii::t('app', 'Create Task'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            [
                'class' => 'yii\grid\DataColumn',
                'label' => 'Project',
                'content' => function ($model, $key, $index, $column) {
                    return Html::a(
                        $model->project->project_title,
                        ['projects/view', 'id' => $model->project_id]
                    );
                },
            ],
            'assignee_id',
            [
                'class' => 'yii\grid\DataColumn',
                'label' => 'Assignee',
                'content' => function ($model, $key, $index, $column) {
                    $first_name = $model->assignee->profile
                        ? $model->assignee->profile->first_name : 'Profile not filled';
                    
                    $last_name = $model->assignee->profile ? $model->assignee->profile->last_name : ' ';

                    if ($model->assignee->profile) {
                        return  Html::a(
                            $first_name . ' ' . $model->assignee->profile->last_name,
                            ['users-profiles/view', 'id' => $model->assignee->profile->id]
                        );
                    }
                    return $first_name . ' ' . $last_name;
                },
                'format' => 'html',
            ],
            'teamlead_id',
            [
                'class' => 'yii\grid\DataColumn',
                'label' => 'Teamlead',
                'content' => function ($model, $key, $index, $column) {
                    return  Html::a(
                        $model->teamlead->profile->first_name . ' ' . $model->teamlead->profile->last_name,
                        ['users-profiles/view', 'id' => $model->teamlead->profile->id]
                    );
                },
                'format' => 'html',
            ],
            'start',
            //'deadline',
            //'end',
            //'status',
            //'description:ntext',
            //'created_at',
            //'updated_at',
            //'project_id',
            [
                'label' => 'Status',
                'content' => function ($model, $key, $index, $column) {
                      return $model->getStatus();
                },
                'format' => 'text',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'visibleButtons' => [
                    'view' => \Yii::$app->user->can('readTask'),
                    'update' => \Yii::$app->user->can('updateTask'),
                    'delete' => \Yii::$app->user->can('deleteTask'),
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
