<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\users_profile\UsersProfile;

/* @var $this yii\web\View */
/* @var $model common\models\users_profile\UsersProfile */
$this->params['profile']['fullName']
    = $profile->first_name . ' ' . $profile->last_name;

$this->params['profile']['image'] = $profile->image ?: '10_man.jpg';
$this->params['profile']['spec'] = $profile->specialization ?: 'Web developer';
$this->params['profile']['id'] = $profile->id ?: 'Not set';

$this->title = $model->first_name . ' ' . $model->last_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users Profiles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->id;
?>
<div class="users-profile-view">

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']); ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]); ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            [
                'label' => 'Status',
                'value' => function ($model) {
                    return $model->status == UsersProfile::STATUS_ACTIVE ? 'Active' : 'Not active';
                }
            ],
            'first_name',
            'last_name',
            'specialization',
            [
                'label' => 'Gender',
                'value' => function ($model) {
                    return $model->sex == 0 ? 'Women' : 'Man';
                },
            ],
            'birthday',
            [
                'label' => 'Email',
                'value' => function ($model) {
                    return $model->user->email;
                },
                'format' => 'email',
            ],
            'phone',
            // 'image',
            'country',
            'created_at',
            'updated_at',
        ],
    ]); ?>

</div>
