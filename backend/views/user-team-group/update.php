<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\user_team_group\UserTeamGroup */

echo $this->render('_profile', ['profile' => $profile]);

$this->title = Yii::t('app', 'Update User Team Group: ' . $model->id, [
    'nameAttribute' => '' . $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Team Groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="user-team-group-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]); ?>

</div>
