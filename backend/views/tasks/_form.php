<?php

use conquer\select2\Select2Widget;
use kartik\datetime\DateTimePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\task\Task */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'project_id')->widget(
        Select2Widget::class,
        [
            'items' => $projects,
        ]
    ); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'teamlead_id')->widget(
        Select2Widget::class,
        [
            'items' => $teamleads,
        ]
    ); ?>

    <?= $form->field($model, 'assignee_id')->widget(
        Select2Widget::class,
        [
            'items' => $assignees,
        ]
    ); ?>

    <?= $form->field($model, 'start')->widget(
        DateTimePicker::class,
        [
            'name' => 'Starting date',
            'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
            'options' => ['placeholder' => 'Select beginning date'],
            'value' => \date('Y-m-d'),
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'startDate' => '2018-01-01',
                'autoclose' => true,
            ],
        ]
    ); ?>

    <?= $form->field($model, 'deadline')->widget(
        DateTimePicker::class,
        [
            'name' => 'Due date',
            'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
            'options' => ['placeholder' => 'Select deadline'],
            'value' => \date('Y-m-d'),
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'startDate' => '2018-01-01',
                'autoclose' => true,
            ],
        ]
    ); ?>

    <?php if (!$isNew) : ?>
        <?= $form->field($model, 'end')->textInput(); ?>
    <?php endif; ?>

    <?= $form->field($model, 'status')->widget(
        Select2Widget::class,
        [
            'items' => $statuses,
        ]
    ); ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
