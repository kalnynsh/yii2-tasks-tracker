<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\project\Project */

echo $this->render('_profile', ['profile' => $profile]);

$this->title = Yii::t('app', 'Create Project');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Projects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-create">

    <?php $isNew = true; ?>

    <?= $this->render('_form', [
        'model' => $model,
        'teamleads' => $teamleads,
        'statuses' => $statuses,
        'isNew' => $isNew,
        'profile' => $profile,
    ]); ?>

</div>
