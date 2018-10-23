<?php

use Yii;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\models\users_profile\UsersProfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'User`s profiles');
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('_profile', ['profile' => $profile]);
?>
<div class="profiles-index">

    <div class="row">
        <div class="col-md-12">
            <?php // echo $this->render('_search', ['model' => $searchModel]);?>
        </div>
    </div>

    <?= GridView::widget(
        [
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'label' => 'Full name',
                    'content' => function ($model, $key, $index, $column) {
                        return $model->first_name . ' ' . $model->last_name;
                    },
                    'format' => ['text'],
                ],
                'teamGroup.team.team_name',
                'teamGroup.group.group_name',
                'specialization:text',
                'phone:text',
                'user.email:email',
                // 'country:text',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => 'Actions',
                    'visibleButtons' => [
                        'view' => \Yii::$app->user->can('readProfile'),
                        'update' => false,
                        'delete' => false,
                    ],
                ],
            ],
        ]
    ); ?>
</div>
