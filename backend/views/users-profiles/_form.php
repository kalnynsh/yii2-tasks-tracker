<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \kartik\datetime\DateTimePicker;
use common\models\users_profile\UsersProfile;

/* @var $this yii\web\View */
/* @var $model common\models\users_profile\UsersProfile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-profile-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput(); ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'specialization')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'sex')->dropDownList(
        [
            '0' => 'Women',
            '1' => 'Man',
        ]
    ); ?>

    <?= $form->field($model, 'birthday')->widget(
        DateTimePicker::class,
        [
            'name' => 'Birthday',
            'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
            'options' => ['placeholder' => 'Select your birthday date'],
            'value' => \date('Y-m-d'),
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'startDate' => '1940-01-01',
                'autoclose' => true,
            ],
        ]
    ); ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'image')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'country')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'status')->dropDownList(
        [
            UsersProfile::STATUS_ACTIVE => 'Active',
            UsersProfile::STATUS_DELETED => 'Deleted',
        ]
    ); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
