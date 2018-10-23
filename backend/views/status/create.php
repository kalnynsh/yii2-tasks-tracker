<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\status\Status */

echo $this->render('_profile', ['profile' => $profile]);

$this->title = Yii::t('app', 'Create Status');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Statuses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="status-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]); ?>

</div>
