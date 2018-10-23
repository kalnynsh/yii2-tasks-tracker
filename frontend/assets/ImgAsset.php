<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class ImgAsset extends AssetBundle
{
    public $basePath = '@webroot/img';
    public $baseUrl = '@web/img';

    public $css = [
    ];

    public $js = [
    ];
    
    public $depends = [
    ];
}
