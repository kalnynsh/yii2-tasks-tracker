<?php

use Yii;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\comment\Comment */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
    <div class="col-md-9">    
        <p><?= Yii::t('app', 'For comment fill out the following field:'); ?></p>    
        <div class="comment-form">

            <?php $form = ActiveForm::begin([
                'id' => 'comment-form',
                'fieldConfig' => [
                    'template' => 
                        "<div>{label}</div><br>
                        <div class=\"col-md-9\">{input}</div><br>
                        <div class=\"col-md-9\">{error}</div><br>",
                    'labelOptions' => ['class' => 'col-md-9 control-label'],
                ],
            ]); ?>

            <?= $form->field($model, 'body')->textarea(['autofocus' => true, 'rows' => 8]); ?>

            <?= Html::activeHiddenInput($model, 'status', ['status' => $model::STATUS_ACTIVE]); ?>

                    <br><br><br><br><br><br><br>
                    <div class="form-group">                    
                            <?= Html::submitButton(
                                'Submit',
                                [
                                    'class' => 'btn btn-primary',
                                    'name' => 'comment-button',
                                ]
                            ); ?>
                    </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
