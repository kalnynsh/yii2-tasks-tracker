<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\task\Task */

echo $this->render('_profile', ['profile' => $profile]);

$this->title = Yii::t('app', 'Create Task');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tasks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-create">

    <?php $isNew = true; ?>

    <?= $this->render('_form', [
        'model' => $model,
        'isNew' => $isNew,
        'projects' => $projects,
        'teamleads' => $teamleads,
        'assignees' => $assignees,
        'statuses' => $statuses,
        'profile' => $profile,
    ]); ?>

</div>
