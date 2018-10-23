<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\status\Status */

echo $this->render('_profile', ['profile' => $profile]);

$this->title = Yii::t('app', 'Update Status: ' . $model->id, [
    'nameAttribute' => '' . $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Statuses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="status-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
