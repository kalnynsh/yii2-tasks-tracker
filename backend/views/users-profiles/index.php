<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use common\models\users_profile\UsersProfile;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->params['profile']['fullName']
    = $profile->first_name . ' ' . $profile->last_name;

$this->params['profile']['image'] = $profile->image ?: '10_man.jpg';
$this->params['profile']['spec'] = $profile->specialization ?: 'Web developer';
$this->params['profile']['id'] = $profile->id ?: 'Not set';

$this->title = Yii::t('app', 'Users Profiles');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-profile-index">

    <?php Pjax::begin(); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Users Profile'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'first_name',
            'last_name',
            [
                'label' => 'Group',
                'value' => function ($model) {
                    return $model->teamGroup->group->group_name;
                },
            ],
            [
                'label' => 'Email',
                'value' => function ($model) {
                    return $model->user->email;
                },
                'format' => 'email',
            ],
            'specialization',
            [
                'label' => 'Team',
                'value' => function ($model) {
                    return $model->teamGroup->team->team_name;
                },
            ],
            [
                'label' => 'Status',
                'value' => function ($model) {
                    return $model->status == UsersProfile::STATUS_ACTIVE ? 'Active' : 'Deleted';
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
