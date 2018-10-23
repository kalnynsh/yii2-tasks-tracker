<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\project\Project */

echo $this->render('_profile', ['profile' => $profile]);

$this->title = 'Project ID: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Projects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-view">

    <p>
    <?php if (\Yii::$app->user->can('updateProject')) : ?>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']); ?>
    <?php endif; ?>
    <?php if (\Yii::$app->user->can('deleteProject')) : ?>
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
            'project_title',
            // 'teamlead_id',
            [
                'label' => 'Teamlead',
                'value' => function ($model) {
                    return Html::a(
                        $model->teamleadProfile->first_name
                        . ' '
                        . $model->teamleadProfile->last_name,
                        [
                            'users-profiles/view',
                            'id' => $model->teamleadProfile->id
                        ]
                    );
                },
                'format' => 'html',
            ],
            'status_id',
            'description:ntext',
            'start',
            'deadline',
            'end',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',

        ],
    ]); ?>

</div>
