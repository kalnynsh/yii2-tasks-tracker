<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\users_profile\UsersProfile */

$this->title = Yii::t('app', 'Create Users Profile');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users Profiles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-profile-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
