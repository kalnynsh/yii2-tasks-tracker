<?php
/** @var common\models\users_profile\UsersProfile $model */
use Yii;
use \yii\helpers\Html;
use \yii\bootstrap\ActiveForm;
use kartik\datetime\DateTimePicker;

echo $this->render('_profile', ['profile' => $profile]);

$form = ActiveForm::begin([
    'id' => 'create_profile',
    'options' => [
        'class' => 'form-vertical',
    ],
]);

echo $form->field($model, 'first_name')->textInput();
echo $form->field($model, 'last_name')->textInput();
echo $form->field($model, 'sex')->radioList(['1' => 'Male', '0' => 'Fimale']);

echo $form->field($model, 'birthday')->widget(
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
);

echo $form->field($model, 'specialization')->textInput();
echo $form->field($model, 'phone')->textInput();
echo $form->field($model, 'country')->textInput();

echo Html::submitButton(Yii::t('app', 'Create profile'), ['class' => 'btn btn-success']);
ActiveForm::end();
