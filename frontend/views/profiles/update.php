<?php

use Yii;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\users_profile\UsersProfile */
echo $this->render('_profile', ['profile' => $profile]);

$fullName = $model->first_name . ' ' . $model->last_name;

$this->title = Yii::t('app', 'Update Profile: ') . $fullName;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Profiles'), 'url' => ['index']];
$this->params['breadcrumbs'][]
    = ['label' => $fullName, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] =  Yii::t('app', 'Update');
?>
<div class="profile-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]); ?>

</div>
