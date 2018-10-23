<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\task\Task */

$this->title = 'Add comment to task: ' . $model->task->title;
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['/tasks']];
$this->params['breadcrumbs'][] = [
    'label' => $model->task->title,
    'url' => [
        'view',
        'id' => $model->task_id
    ],
];

echo $this->render('_profile', ['profile' => $profile]);
?>
<div class="tasks-comment">

    <h1><?= Html::encode($this->title); ?></h1>

    <?= $this->render(
        '_comment_form',
        [
            'model' => $model,
        ]
    ); ?>

</div>
