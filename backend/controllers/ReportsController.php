<?php

namespace backend\controllers;

use Yii;
use yii\console\Controller;
use common\models\task\Task;
use common\models\status\Status;
use yii\data\ActiveDataProvider;
use common\models\project\Project;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use common\models\project\ProjectSearch;
use common\models\users_profile\UsersProfile;
use common\models\user_team_group\UserTeamGroup;
use common\models\task\TaskQuery;

/**
 * Reports conroller for desplaying reports
 */
class ReportsController extends Controller
{
    /**
     * Lists all Project models.
     * @return mixed
     */
    public function actionIndex()
    {
        $profile = (new UsersProfile())->getProfile();

        $queryProject = Project::find()->active();
        $projectsCount = $queryProject->count();
        $dataProviderProjects = new ActiveDataProvider([
            'query' => $queryProject,
        ]);

        $queryTasks =  new TaskQuery(Task::class);

        $queryActiveTasks = $queryTasks->active();
        $activeTasksCount = $queryActiveTasks->count();
        $dataProviderActiveTasks = new ActiveDataProvider([
            'query' => $queryActiveTasks,
        ]);
        
        $queryDoneTasks = (new TaskQuery(Task::class))
            ->done()
            ->onWeek();
        $doneTasksCount = $queryDoneTasks->count();
        $dataProviderDoneTasks = new ActiveDataProvider([
            'query' => $queryDoneTasks,
        ]);
        
        $queryOverdueTask = (new TaskQuery(Task::class))->overdue();
        $overdueTasksCount = $queryOverdueTask->count();

        $dataProviderOverdueTask = new ActiveDataProvider([
            'query' => $queryOverdueTask,
        ]);

        return $this->render('index', [
            'profile' => $profile,

            'dataProviderProjects' => $dataProviderProjects,
            'projectsCount' => $projectsCount,

            'dataProviderTasks' => $dataProviderActiveTasks,
            'activeTasksCount' => $activeTasksCount,

            'dataProviderDoneTasks' => $dataProviderDoneTasks,
            'doneTasksCount' => $doneTasksCount,

            'dataProviderOverdueTask' => $dataProviderOverdueTask,
            'overdueTasksCount' => $overdueTasksCount,
        ]);
    }
}
