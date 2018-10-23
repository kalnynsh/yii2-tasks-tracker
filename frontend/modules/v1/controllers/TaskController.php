<?php

namespace frontend\modules\v1\controllers;

use Yii;
use yii\helpers\Url;
use yii\filters\AccessControl;
use \yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBasicAuth;
use yii\web\ForbiddenHttpException;
use yii\filters\auth\HttpBearerAuth;
use \frontend\modules\v1\models\task\TaskRest;
use \frontend\modules\v1\models\task\TaskRestSearch;

/**
 * Task RESTfull controller for the `v1` module
 */
class TaskController extends ActiveController
{
    public $modelClass = TaskRest::class;

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator']['only'] = [
            'create',
            'update',
            'delete'
        ];
        
        $behaviors['authenticator']['authMethods'] = [
            HttBasicAuth::class,
            HttpBearerAuth::class,
        ];

        // $behaviors['access'] = [
        //     'class' => AccessControl::class,
        //     'only' => ['create', 'update', 'delete'],
        //     'rules' => [
        //         'allow' => true,
        //         // 'roles' => ['admin', 'teamlead'],
        //         'roles' => ['@'],
        //     ]
        // ];

        return $behaviors;
    }

    /**
     * Unset action: create
     * For index using prepareDataProvider
     *
     * @return mix $actions
     */
    public function actions()
    {
        $actions = parent::actions();

        unset($actions['create']);
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];

        return $actions;
    }

    public function actionCreate()
    {
        $model = new \common\models\task\Task();
        $model->teamlead_id = Yii::$app->user->id;

        $model->load(Yii::$app->getRequest()->getBodyParams(), '');

        if ($model->save()) {
            $response = Yii::$app->getResponse();
            $response->setStatus(201);
            $id = \implode(',', \array_values($model->getPrimaryKey(true)));
            $response->getHeaders()->set('Location', Url::toRoute(['view', 'id' => $id], true));
        } elseif (!$model->hasErrors()) {
            throw new ServerErrorHttpException('Fail to create the object for unknown reason.');
        }

        return $model;
    }

    /**
     * Return searchModel with params
     *
     * @return activeQuery
     */
    public function prepareDataProvider()
    {
        $searchModel = new TaskRestSearch();
        $params = Yii::$app->request->queryParams;

        return $searchModel->search($params);
    }

    /**
     * Check if 'admin', or 'teamlead' belong task`s team
     *
     * @param object $action
     * @param [object $model
     * @param array $params
     * @return void|ForbiddenHttpException
     */
    public function checkAccess($action, $model = null, $params = [])
    {
        $teamId = $model ? $model->getTeamlead()->getUserTeamGroup()->team_id : null;

        if (in_array($action, ['update', 'delete'])) {
            if (!Yii::$app->user->can('updateTask', ['team_id' => $teamId])
                    || !Yii::$app->user->can('deleteTask', ['team_id' => $teamId])
                ) {
                    throw new ForbiddenHttpException('Forbidden.');
            }
        }
    }
}
