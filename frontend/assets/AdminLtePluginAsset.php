<?php

use yii\web\AssetBundle;

class AdminLtePluginAsset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/plugins';

    public $js = [
    ];

    public $css = [
    ];

    public $depends = [
        'backend\assets\AdminLteAsset',
    ];
}
