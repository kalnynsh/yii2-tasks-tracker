<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

echo $this->render('_profile', ['profile' => $profile]);

$this->title = Yii::t('app', 'User Team Groups');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-team-group-index">

    <?php Pjax::begin(); ?>
    <?php if (\Yii::$app->user->can('createTeam')) : ?>
        <p>
            <?= Html::a(Yii::t('app', 'Create User Team Group'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            [
                'label' => 'Full name',
                'value' => function ($model) {
                    return
                        $model->profile->first_name
                        . ' '
                        . $model->profile->last_name;
                },
            ],
            'group_id',
            [
                'label' => 'Group',
                'value' => function ($model) {
                    return $model->group->group_name;
                },
            ],
            'team_id',
            [
                'label' => 'Team',
                'value' => function ($model) {
                    return $model->team->team_name;
                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
