<?php
$params = \array_merge(
    require __DIR__ . '/../../../../common/config/params.php',
    require __DIR__ . '/../../../../common/config/params-local.php'
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => '\frontend\modules\v1\controllers',
    'components' => [
        'request' => [
            'class' => 'yii\web\Request',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
                'text/xml' => 'yii\web\XmlParser',
            ],
        ],
        'response' => [
            'class' => 'yii\web\Response',
            'formatters' => [
                'json' => [
                    'class' => 'yii\web\JsonResponseFormatter',
                    'prettyPrint' => YII_DEBUG,
                    'encodeOptions' => JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
                ],
            ],
        ],
        'user' => [
            'class' => 'yii\web\User',
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
            'enableSession' => false,
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                'v1' => 'v1/app/index',
                'v1/' => 'v1/app/index',
                'POST v1/auth' => 'v1/app/login',
                'POST v1/app/login' => 'v1/app/login',
                ['class' => 'yii\rest\UrlRule', 'controller' => 'v1/task'],
            ],
        ],
    ],
    'params' => $params,
];
