<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\task\Task */

echo $this->render('_profile', ['profile' => $profile]);

$this->title = Yii::t('app', 'Update Task: ' . $model->title, [
    'nameAttribute' => '' . $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tasks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="task-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]); ?>

</div>
