<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\group\Group */

echo $this->render('_profile', ['profile' => $profile]);

$this->title = Yii::t('app', 'Create Group');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]); ?>

</div>
