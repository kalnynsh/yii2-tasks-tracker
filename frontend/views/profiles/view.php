<?php

use Yii;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\users_profile\UsersProfile */

$this->title = $model->first_name . ' ' . $model->last_name;
$this->params['breadcrumbs'][]
    = ['label' => Yii::t('app', 'Profiles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('_profile', ['profile' => $profile]);
?>
<div class="profile-view">

    <?php if (Yii::$app->user->can('updateProfile', ['profile' => $model])) : ?>
        <p>
            <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']); ?>
        </p>
    <?php endif; ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'first_name',
            'last_name',
            'teamGroup.team.team_name',
            'teamGroup.group.group_name',
            'birthday',
            'specialization',
            'user.email:email',
            'phone',
            'country',
        ],
    ]); ?>

</div>
