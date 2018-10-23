<?php

namespace backend\controllers;

use Yii;
use common\models\team\Team;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use common\models\users_profile\UsersProfile;

/**
 * TeamsController implements the CRUD actions for Team model.
 */
class TeamsController extends BaseController
{
    /**
     * Lists all Team models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Team::find(),
        ]);
        $profile = (new UsersProfile())->getProfile();

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'profile' => $profile,
        ]);
    }

    /**
     * Displays a single Team model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (Yii::$app->user->can('readTeam')) {
            $profile = (new UsersProfile())->getProfile();

            return $this->render('view', [
                'model' => $this->findModel($id),
                'profile' => $profile,
            ]);
        }

        return new ForbiddenHttpException(Yii::t('app', 'This resouce forbidden for you.'));
    }

    /**
     * Creates a new Team model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->can('createTeam')) {
            $model = new Team();
            $profile = (new UsersProfile())->getProfile();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('create', [
                'model' => $model,
                'profile' => $profile,
            ]);
        }

        return new ForbiddenHttpException(Yii::t('app', 'This resouce forbidden for you.'));
    }

    /**
     * Updates an existing Team model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->can('updateTeam')) {
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
     * Deletes an existing Team model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->can('deleteTeam')) {
            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        }

        return new ForbiddenHttpException(Yii::t('app', 'This resouce forbidden for you.'));
    }

    /**
     * Finds the Team model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Team the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Team::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
