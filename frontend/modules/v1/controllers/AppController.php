<?php

namespace frontend\modules\v1\controllers;

use Yii;
use yii\rest\Controller;
use \frontend\modules\v1\models\LoginForm;

class AppController extends Controller
{
    public function actionIndex()
    {
        return 'api_v1';
    }

    public function actionLogin()
    {
        $model = new LoginForm();
        $model->load(Yii::$app->request->bodyParams, '');

        if ($token = $model->auth()) {
            return $token;
        } else {
            $model;
        }
    }

    protected function verbs()
    {
        return [
            'login' => ['post'],
        ];
    }
}
