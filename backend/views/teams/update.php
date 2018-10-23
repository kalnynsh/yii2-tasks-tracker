<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\team\Team */

echo $this->render('_profile', ['profile' => $profile]);

$this->title = Yii::t('app', 'Update Team: ' . $model->id, [
    'nameAttribute' => '' . $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Teams'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="team-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]); ?>

</div>
