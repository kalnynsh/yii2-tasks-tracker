<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

echo $this->render('_profile', ['profile' => $profile]);
$this->title = Yii::t('app', 'Groups');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-index">

    <?php Pjax::begin(); ?>

    <?php if (\Yii::$app->user->can('createTeam')) : ?>
        <p>
            <?= Html::a(Yii::t('app', 'Create Group'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'group_name',
            'description',
            'created_at',
            'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'visibleButtons' => [
                    'view' => \Yii::$app->user->can('readTeam'),
                    'update' => \Yii::$app->user->can('updateTeam'),
                    'delete' => \Yii::$app->user->can('deleteTeam'),
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
