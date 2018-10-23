<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\user_team_group\UserTeamGroup */

echo $this->render('_profile', ['profile' => $profile]);

$this->title = Yii::t('app', 'Create User Team Group');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Team Groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-team-group-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
