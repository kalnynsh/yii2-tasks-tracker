<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\users_profile\UsersProfile */
$this->params['profile']['fullName']
    = $profile->first_name . ' ' . $profile->last_name;

$this->params['profile']['image'] = $profile->image ?: '10_man.jpg';
$this->params['profile']['spec'] = $profile->specialization ?: 'Web developer';
$this->params['profile']['id'] = $profile->id ?: 'Not set';

$this->title = Yii::t('app', 'Update Users Profile: ' . $model->id, [
    'nameAttribute' => '' . $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users Profiles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="users-profile-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
