<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\task\Task */

echo $this->render('_profile', ['profile' => $profile]);

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tasks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-view">

    <p>
        <?php if (\Yii::$app->user->can('updateTask')) : ?>
            <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']); ?>
        <?php endif; ?>
        <?php if (\Yii::$app->user->can('deleteTask')) : ?>
            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]); ?>
        <?php endif; ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'description:ntext',
            'project_id',
            'project.project_title',
            'assignee_id',
            'assignee.username',
            'assignee.email:email',
            'teamlead_id',
            'teamlead.username',
            'teamlead.email:email',
            'start',
            'deadline',
            'end',
            'status',
            'created_at',
            'updated_at',
        ],
    ]); ?>

</div>
