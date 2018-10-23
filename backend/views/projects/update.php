<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\project\Project */

echo $this->render('_profile', ['profile' => $profile]);

$this->title = Yii::t('app', 'Update Project: ' . $model->id, [
    'nameAttribute' => '' . $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Projects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="project-update">

    <?php $isNew = false; ?>

    <?= $this->render('_form', [
        'model' => $model,
        'teamleads' => $teamleads,
        'statuses' => $statuses,
        'isNew' => $isNew,
    ]); ?>

</div>
