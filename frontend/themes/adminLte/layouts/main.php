<?php
use yii\helpers\Html;

use frontend\assets\AppAsset;
use frontend\assets\ImgUsersAsset;
use frontend\assets\AdminLteAsset;
use frontend\assets\adminlte\helpers\AdminLteHelper;

/* @var $this \yii\web\View */
/* @var $content string */
$imgBundle = ImgUsersAsset::register($this);
AppAsset::register($this);
AdminLteAsset::register($this);

$directoryAsset = $imgBundle->baseUrl;
?>
    <?php $this->beginPage()?>
    <!DOCTYPE html>
    <html lang="<?=Yii::$app->language?>">
    <head>
        <meta charset="<?=Yii::$app->charset?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?=Html::csrfMetaTags()?>
        <title><?=Html::encode($this->title)?></title>
        <?php $this->head()?>
    </head>
    <body class="hold-transition <?= AdminLteHelper::skinClass(); ?> sidebar-mini">
    <?php $this->beginBody()?>
    <div class="wrapper">

        <?=$this->render(
            'header.php',
            ['directoryAsset' => $directoryAsset]
        )?>

        <?=$this->render(
            'left.php',
            ['directoryAsset' => $directoryAsset]
        )?>

        <?=$this->render(
            'content.php',
            ['content' => $content, 'directoryAsset' => $directoryAsset]
        )?>

    </div>

    <?php $this->endBody()?>
    </body>
    </html>
    <?php $this->endPage()?>
