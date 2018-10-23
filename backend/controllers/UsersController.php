<?php

namespace backend\controllers;

use Yii;
use common\models\User;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use backend\models\user\CreateForm;
use common\models\users_profile\UsersProfile;

/**
 * UsersController implements the CRUD actions for User model.
 */
class UsersController extends BaseController
{
    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
        ]);
        $profile = (new UsersProfile())->getProfile();

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'profile' => $profile,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (Yii::$app->user->can('readUser')) {
            $profile = (new UsersProfile())->getProfile();

            return $this->render('view', [
                'model' => $this->findModel($id),
                'profile' => $profile,
            ]);
        }

        return new ForbiddenHttpException(
            Yii::t('app', 'This resouce forbidden for you.')
        );
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->can('createUser')) {
            $model = new CreateForm();
            $profile = (new UsersProfile())->getProfile();

            if ($model->load(Yii::$app->request->post())) {
                if ($user = $model->create()) {
                    if (Yii::$app->getUser()->login($user)) {
                        return $this->redirect([
                            'view',
                            'id' => Yii::$app->getUser()->id,
                        ]);
                    }
                }
            }

            return $this->render('create', [
                'model' => $model,
                'profile' => $profile,
            ]);
        }

        return new ForbiddenHttpException(
            Yii::t('app', 'This resouce forbidden for you.')
        );
    }

    /**
     * Updates an existing User model.
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

        return new ForbiddenHttpException(
            Yii::t('app', 'This resouce forbidden for you.')
        );
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->can('deleteUser')) {
            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        }

        return new ForbiddenHttpException(
            Yii::t('app', 'This resouce forbidden for you.')
        );
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(
            Yii::t('app', 'The requested page does not exist.')
        );
    }
}
