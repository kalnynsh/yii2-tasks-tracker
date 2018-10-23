<?php

use Yii;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use conquer\select2\Select2Widget;

/* @var $this yii\web\View */
/* @var $model common\models\project\Project */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'project_title')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'teamlead_id')->widget(
        Select2Widget::class,
        [
            'items' => $teamleads,
        ]
    ); ?>

    <?php if ($isNew) : ?>
        <?= Html::activeHiddenInput($model, 'status_id', ['value' => 10]); ?>
        <?= Html::activeHiddenInput($model, 'created_by', ['value' => Yii::$app->user->getId()]); ?>
        <?= Html::activeHiddenInput($model, 'updated_by', ['value' => Yii::$app->user->getId()]); ?>
    <?php else : ?>
        <?= $form->field($model, 'status_id')->widget(
            Select2Widget::class,
            [
                'items' => $statuses,
            ]
        ); ?>
         <?= Html::activeHiddenInput($model, 'updated_by', ['value' => Yii::$app->user->getId()]); ?>
    <?php endif; ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]); ?>

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
        <?= $form->field($model, 'end')->widget(
            DateTimePicker::class,
            [
                'name' => 'Ending date',
                'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
                'options' => ['placeholder' => 'Select ending date'],
                'value' => \date('Y-m-d'),
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'startDate' => '2018-01-01',
                    'autoclose' => true,
                ],
            ]
        ); ?>
    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
