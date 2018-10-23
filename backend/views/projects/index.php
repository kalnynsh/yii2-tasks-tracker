<?php

use Yii;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use common\components\helpers\HtmlListHelper;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

echo $this->render('_profile', ['profile' => $profile]);

$this->title = Yii::t('app', 'Projects');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">

    <?php Pjax::begin(); ?>

    <?php if (Yii::$app->user->can('createProject')) : ?>
        <p>
            <?= Html::a(Yii::t('app', 'Create Project'), ['create'], ['class' => 'btn btn-success']); ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'class' => 'yii\grid\DataColumn',
                'label' => 'Project`s title',
                'content' => function ($model, $key, $index, $column) {
                    return Html::a(
                        Yii::t('app', $model->project_title),
                        ['projects/view', 'id' => $model->id]
                    );
                },
            ],
            // 'teamlead_id',
            [
                'class' => 'yii\grid\DataColumn',
                'label' => 'Teamlead',
                'content' => function ($model, $key, $index, $column) {
                    return Html::a(
                        $model->teamleadProfile->first_name
                        . ' '
                        . $model->teamleadProfile->last_name,
                        [
                            'users-profiles/view',
                            'id' => $model->teamleadProfile->id
                        ]
                    );
                }
            ],
            'status.status_name',
            'description:ntext',
            'start',
            'deadline:date',
            'end:date',
            // 'created_by',
            // 'updated_by',
            // 'created_at:date',
            // 'updated_at:date',
            [
                    'class' => 'yii\grid\DataColumn',
                    'label' => 'Join tasks',
                    'content' => function ($model, $key, $index, $column) {
                        return HtmlListHelper::list($model, 'tasks', 'title', $key, $index, $column);
                    }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'visibleButtons' => [
                    'view' => Yii::$app->user->can('readProject'),
                    'update' => Yii::$app->user->can('updateProject'),
                    'delete' => Yii::$app->user->can('deleteProject'),
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
