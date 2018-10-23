<?php

namespace frontend\controllers;

use \Yii;
use common\models\task\Task;
use common\models\task\TaskQuery;
use common\models\task\TaskSearch;
use yii\web\NotFoundHttpException;
use frontend\models\comment\Comment;
use common\models\users_profile\UsersProfile;
use common\models\users_profile\UsersProfileQuery;

/**
 * TasksController - class handels Task model and views/tasks
 */
class TasksController extends \yii\web\Controller
{
    /**
     * List of all Task models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaskSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $profile = (new UsersProfile())->getProfile();

        return $this->render(
            'index',
            [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'profile' => $profile,
            ]
        );
    }

    /**
     * Displays calendar list of user`s tasks.
     *
     * @return string
     */
    public function actionCalendar()
    {
        // Get current ID of logined user
        $userId = Yii::$app->user->getId() ?: '1000';
        $profile = (new UsersProfile())->getProfile();

        // Fill array keyes with [1, .., date("t")].
        // date("t") - count of days in current month
        $calendar = array_fill_keys(range(1, date("t")), []);
        $model = new TaskQuery(Task::class);

        foreach ($model->getByCurrentMonth($userId)->all() as $task) {
            // Get current $task->date and create new DateTime object
            // $date->format("j") -- Day of the month: 1, 2, .., 31
            // Fill array $calender with $task objects
            $date = \DateTime::createFromFormat("Y-m-d H:i:s", $task->deadline);
            $calendar[$date->format("j")][] = $task;
        }

        return $this->render('calendar', \compact('calendar', 'profile'));
    }

    /**
     * Displays a single Task model.
     *
     * @param integer $id - ID
     *
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $profile = (new UsersProfile())->getProfile();

        return $this->render(
            'view',
            [
                'model' => $this->findModel($id),
                'profile' => $profile,
            ]
        );
    }

    /**
     * Function for add commant
     *
     * @return boolean|string
     */
    public function actionAddComment()
    {
        $profile = (new UsersProfile())->getProfile();
        $model = new Comment();
        $model->task_id = Yii::$app->request->get('task_id');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->task_id]);
        }

        return $this->render('add-comment', \compact('model', 'profile'));
    }

    /**
     * Finds the Task model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id - ID
     *
     * @return Task the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Task::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
