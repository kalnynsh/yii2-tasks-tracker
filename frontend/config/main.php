<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'name' => 'D`task tracker',
    'modules' => [
        'v1' => [
            'class' => frontend\modules\v1\Module::class,
        ]
    ],
    'components' => [
        'request' => [
            'baseUrl' => '',
            'csrfParam' => '_csrf-frontend',
        ],
        'response' => [
            'class' => 'yii\web\Response',
            'formatters' => [
                'json' => [
                    'class' => 'yii\web\JsonResponseFormatter',
                    'prettyPrint' => YII_DEBUG,
                    'encodeOptions' => JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
                ],
                'html' => [
                    'class' => yii\web\HtmlResponseFormatter::class,
                ],
            ],
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => false,
            'showScriptName' => false,
            'rules' => [
                'GET v1' => 'v1/app/index',
                'POST v1/auth' => 'v1/app/login',
                [
                    'class' => yii\rest\UrlRule::class,
                    'controller' => [
                        'v1/task',
                    ],
                ],
                '' => 'site/index',
                'site/index' => 'site/index',
                'site/login' => 'site/login',
                '/login' => 'site/login',
                'site/contact' => 'site/contact',
                '/contact' => 'site/contact',
                'site/about' => 'site/about',
                '/about' => 'site/about',
                'site/signup' => 'site/signup',
                '/signup' => 'site/signup',
                'site/logout' => 'site/logout',
                '/logout' => 'site/logout',
                'site/request-password-reset' => 'site/request-password-reset',
                'site/reset-password' => 'site/reset-password',
                'profiles' => 'profiles/index',
                'profiles/view?id=<id:\d+>' => 'profiles/view',
                'profiles/view/<id:\d+>' => 'profiles/view',

                '<_c:[\w-]+>' => '<_c>/index',
                '<_c:[\w-]+>/view?id=<id:\d+>' => '<_c>/view',
                '<_c:[\w-]+>/view/<id:\d+>' => '<_c>/view',
            ],
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views' => '@app/themes/adminLte/',
                ],
            ],
        ],
        'assetManager' => [
            'class' => 'yii\web\AssetManager',
            'bundles' => [
                'frontend\assets\AdminLteAsset' => [
                    'skin' => 'skin-green-light',
                ],
                'insolita\wgadminlte\JsCookieAsset' => [
                    'depends' => [
                        'yii\web\YiiAsset',
                        'frontend\assets\AdminLteAsset',
                    ],
                ],
                'insolita\wgadminlte\CollapseBoxAsset' => [
                    'depends' => [
                        'insolita\wgadminlte\JsCookieAsset',
                    ],
                ],
            ],
        ],
    ],
    'params' => $params,
];
