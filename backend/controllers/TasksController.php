<?php

namespace backend\controllers;

use Yii;
use common\models\project\Project;
use common\models\status\Status;
use common\models\task\Task;
use common\models\user_team_group\UserTeamGroup;
use common\models\users_profile\UsersProfile;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

/**
 * TasksController implements the CRUD actions for Task model.
 */
class TasksController extends BaseController
{
    /**
     * Lists all Task models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Task::find(),
        ]);
        $profile = (new UsersProfile())->getProfile();

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'profile' => $profile,
        ]);
    }

    /**
     * Displays a single Task model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (Yii::$app->user->can('readTask')) {
            $profile = (new UsersProfile())->getProfile();

            return $this->render('view', [
                'model' => $this->findModel($id),
                'profile' => $profile,
            ]);
        }

        return new ForbiddenHttpException(Yii::t('app', 'This resouce forbidden for you.'));
    }

    /**
     * Creates a new Task model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->can('createTask')) {
            $model = new Task();
            $projects = (new Project())->getProjectsArray();
            $teamleads = (new UserTeamGroup)->getTeamleadsArray();
            $assignees = (new UserTeamGroup)->getAssigneesArray();
            $statuses = (new Status)->getStatusesArray();
            $profile = (new UsersProfile())->getProfile();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('create', [
                'model' => $model,
                'projects' => $projects,
                'teamleads' => $teamleads,
                'assignees' => $assignees,
                'statuses' => $statuses,
                'profile' => $profile,
            ]);
        }

        return new ForbiddenHttpException(Yii::t('app', 'This resouce forbidden for you.'));
    }

    /**
     * Updates an existing Task model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->can('updateProject')) {
            $model = $this->findModel($id);
            $profile = (new UsersProfile())->getProfile();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('update', [
                'model' => $model,
                'profile' => $profile,
            ]);
        }

        return new ForbiddenHttpException(Yii::t('app', 'This resouce forbidden for you.'));
    }

    /**
     * Deletes an existing Task model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->can('deleteProject')) {
            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        }

        return new ForbiddenHttpException(Yii::t('app', 'This resouce forbidden for you.'));
    }

    /**
     * Finds the Task model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Task the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Task::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
