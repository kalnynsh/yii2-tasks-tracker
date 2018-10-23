<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

echo $this->render('_profile', ['profile' => $profile]);

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <?php Pjax::begin(); ?>

    <?php if (\Yii::$app->user->can('createUser')) : ?>
        <p>
            <?= Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'username',
            'email:email',
            [
               'class' => yii\grid\DataColumn::class,
               'label' => 'Status',
               'content' => function ($model, $key, $index, $column) {
                    if ($model->status === common\models\User::STATUS_ACTIVE) {
                       return 'Active';
                    } elseif ($model->status === common\models\User::STATUS_DELETED) {
                        return 'Deleted';
                    }
               },
            ],
            'created_at:date',
            'updated_at:date',

            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'visibleButtons' => [
                        'view' => \Yii::$app->user->can('readUser'),
                        'update' => \Yii::$app->user->can('updateUser'),
                        'delete' => \Yii::$app->user->can('deleteUser'),
                    ],
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
