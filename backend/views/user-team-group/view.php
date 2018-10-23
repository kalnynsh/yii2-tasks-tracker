<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\user_team_group\UserTeamGroup */

echo $this->render('_profile', ['profile' => $profile]);

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Team Groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-team-group-view">

    <p>
        <?php if (\Yii::$app->user->can('updateTeam')) : ?>
            <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']); ?>
        <?php endif; ?>
        <?php if (\Yii::$app->user->can('deleteTeam')) : ?>
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
            'user_id',
            [
                'label' => 'User',
                'value' =>
                    $model->profile->first_name . ' ' . $model->profile->last_name,
            ],
            'group_id',
            'team_id',
        ],
    ]); ?>

</div>
