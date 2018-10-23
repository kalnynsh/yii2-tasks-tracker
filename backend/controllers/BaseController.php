<?php

namespace backend\controllers;

use yii\web\Controller;
use yii\filters\VerbFilter;
use common\models\group\Group;
use yii\filters\AccessControl;

/**
 * BaseController basic for inheritance
 */
class BaseController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['view'],
                        'roles' => [
                            Group::ADMIN,
                            Group::TEAMLEAD,
                            Group::ASSIGNEE,
                        ],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create'],
                        'roles' => [
                            Group::ADMIN,
                            Group::TEAMLEAD,
                        ],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['update'],
                        'roles' => [
                            Group::ADMIN,
                            Group::TEAMLEAD,
                        ],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['delete'],
                        'roles' => [
                            Group::ADMIN,
                            Group::TEAMLEAD,
                        ],
                    ],
                ],
            ]
        ];
    }
}
