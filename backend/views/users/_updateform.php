<?php

use yii\helpers\Html;
use \yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin([
        'id' => 'create_user',
        'options' => [
            'class' => 'form-vertical',
        ],
    ]); ?>
    
    <?= $form->field($model, 'status')
        ->radioList(['10' => 'Active', '1' => 'Deleted'])
        ->label(Yii::t('app', 'User`s status')); ?>

    <?= $form->field($model, 'username')
        ->textInput(['autofocus' => true])
        ->hint(Yii::t('app', 'Enter name'))
        ->label('User name'); ?>

    <?= $form->field($model, 'email')->input('email')->hint(Yii::t('app', 'Enter email'))->label('Email'); ?>

    <div class="form-group">
        <div class="col-md-offset-1 col-md-11">
            <?= Html::submitButton(Yii::t('app', 'Update'), ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
