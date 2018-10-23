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

    <?= Html::hiddenInput('status', 10) ?>

    <?= $form->field($model, 'username')
        ->textInput(['autofocus' => true])
        ->hint(Yii::t('app', 'Enter name'))
        ->label('User name'); ?>

    <?= $form->field($model, 'email')->input('email')->hint(Yii::t('app', 'Enter email'))->label('Email'); ?>

    <?= $form->field($model, 'password')->passwordInput()->hint(Yii::t('app', 'Enter password'))->label('Password'); ?>

    <div class="form-group">
        <div class="col-md-offset-1 col-md-11">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
