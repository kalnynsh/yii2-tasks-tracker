<?php

namespace frontend\controllers;

use Yii;
use common\models\users_profile\UsersProfile;
use common\models\users_profile\UsersProfileSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use \frontend\models\default_profile\DefaultProfile;

/**
 * ProfilesController implements the CRUD actions for UsersProfile model.
 */
class ProfilesController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => [],
                        'allow' => true,
                        'roles' => ['admin', 'teamlead', 'assignee'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all UsersProfile models.
     * @return mixed
     */
    public function actionIndex()
    {
        $profile = (new UsersProfile())->getProfile();

        $searchModel = new UsersProfileSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'profile' => $profile,
        ]);
    }

    /**
     * Displays a single UsersProfile model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $profile = (new UsersProfile())->getProfile();

        return $this->render('view', [
            'model' => $this->findModel($id),
            'profile' => $profile,
        ]);
    }

    /**
     * Creates a new UsersProfile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $profile = (new UsersProfile())->getProfile();

        if ($profile instanceof DefaultProfile) {
            $model = new UsersProfile();
            $model->user_id = Yii::$app->user->getId();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                unset($profile);

                return $this->redirect(
                    [
                        'view',
                        'id' => $model->id,
                        'profile' => $model,
                    ]
                );
            }
        } else {
            return $this->redirect('update', [
                'model' => $model,
                'profile' => $profile,
            ]);
        }

        return $this->render('create', [
            'model' => $model,
            'profile' => $profile
        ]);
    }

    /**
     * Updates an existing UsersProfile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
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

    /**
     * Finds the UsersProfile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UsersProfile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UsersProfile::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
