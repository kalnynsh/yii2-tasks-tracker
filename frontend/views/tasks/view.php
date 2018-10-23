<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\tables\Task */

$this->title = $model->title;
$this->params['breadcrumbs'][]
    = ['label' => Yii::t('app', 'Tasks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('_profile', ['profile' => $profile]);
?>
<div class="task-view">

    <?=DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'assignee_id',
            'teamlead_id',
            'start',
            'end',
            'deadline',
            'description:html',
            'status',
        ],
    ]);?>

    <div class="row">
        <div class="col-lg-8">
            <button class="btn btn-lg btn-primary">
                <?=Html::a(
                    Yii::t('app', 'Add comment'),
                    Url::to(['add-comment', 'task_id' => $model->id]),
                    ['class' => 'link-white']
                );?>
            </button>
        </div>
    </div>
</div> 
