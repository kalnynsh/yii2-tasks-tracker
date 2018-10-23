<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User */

echo $this->render('_profile', ['profile' => $profile]);

$this->title = Yii::t('app', 'Update User: ' . $model->id, [
    'nameAttribute' => '' . $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="user-update">

    <?= $this->render('_updateform', [
        'model' => $model,
    ]) ?>

</div>
