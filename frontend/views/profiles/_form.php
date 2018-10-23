<?php

use kartik\datetime\DateTimePicker;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\users_profile\UsersProfile */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="profile-form">

    <?php $form = ActiveForm::begin([
            'id' => 'update_profile',
            'options' => [
                'class' => 'form-vertical',
            ],
    ]);?>

    <?=$form->field($model, 'first_name')->textInput();?>

    <?=$form->field($model, 'last_name')->textInput();?>

    <?=$form->field($model, 'sex')->radioList([1 => 'Male', 0 => 'Fimale']);?>    

    <?=$form->field($model, 'birthday')->widget(
        DateTimePicker::class,
        [
            'name' => 'Birthday date',
            'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
            'options' => ['placeholder' => 'Select your birthday date'],
            'value' => \date('Y-m-d'),
            // 'convertFormat' => false,
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'startDate' => '1950-01-01',
                'autoclose' => true,
            ],
        ]
    );?>
 
    <?=$form->field($model, 'specialization')->textInput();?>

    <?=$form->field($model, 'phone')->textInput();?>

    <?=$form->field($model, 'country')->textInput();?>

    <div class="form-group">
        <?=Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']);?>
    </div>

    <?php ActiveForm::end();?>

</div>
