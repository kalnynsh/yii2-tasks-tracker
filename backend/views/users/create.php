<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User */

echo $this->render('_profile', ['profile' => $profile]);

$this->title = Yii::t('app', 'Create User');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create col-md-4">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_createform', [
        'model' => $model,
    ]) ?>

</div>
