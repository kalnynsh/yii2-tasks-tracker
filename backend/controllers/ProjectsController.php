<?php

namespace backend\controllers;

use Yii;
use common\models\status\Status;
use yii\data\ActiveDataProvider;
use common\models\project\Project;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use common\models\project\ProjectSearch;
use common\models\users_profile\UsersProfile;
use common\models\user_team_group\UserTeamGroup;

/**
 * ProjectsController implements the CRUD actions for Project model.
 */
class ProjectsController extends BaseController
{
    /**
     * Lists all Project models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProjectSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());
        $profile = (new UsersProfile())->getProfile();

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'profile' => $profile,
        ]);
    }

    /**
     * Displays a single Project model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (Yii::$app->user->can('readProject')) {
                $profile = (new UsersProfile())->getProfile();

                return $this->render('view', [
                    'model' => $this->findModel($id),
                    'profile' => $profile,
                ]);
        }

        return new ForbiddenHttpException(Yii::t('app', 'This resouce forbidden for you.'));
    }

    /**
     * Creates a new Project model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->can('createProject')) {
            $model = new Project();
            $teamleads = (new UserTeamGroup)->getTeamleadsArray();
            $statuses = (new Status)->getStatusesArray();
            $profile = (new UsersProfile())->getProfile();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('create', [
                'model' => $model,
                'teamleads' => $teamleads,
                'statuses' => $statuses,
                'profile' => $profile,
            ]);
        }

        return new ForbiddenHttpException(Yii::t('app', 'This resouce forbidden for you.'));
    }

    /**
     * Updates an existing Project model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->can('updateProject')) {
            $model = $this->findModel($id);
            $teamleads = (new UserTeamGroup)->getTeamleadsArray();
            $statuses = (new Status)->getStatusesArray();
            $profile = (new UsersProfile())->getProfile();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('update', [
                'model' => $model,
                'teamleads' => $teamleads,
                'statuses' => $statuses,
                'profile' => $profile,
            ]);
        }

        return new ForbiddenHttpException(Yii::t('app', 'This resouce forbidden for you.'));
    }

    /**
     * Deletes an existing Project model.
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
     * Finds the Project model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Project the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Project::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
