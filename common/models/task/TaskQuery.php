<?php

namespace common\models\task;

use yii\db\ActiveQuery;
use common\models\task\Task;

/**
 * This is the ActiveQuery class for [[Task]].
 *
 * @see Task
 */
class TaskQuery extends ActiveQuery
{
    public $query;

    /**
     * {@inheritdoc}
     *
     */
    public function init()
    {
        parent::init();
        $this->query = Task::find();
    }

    /**
     * Find active Tasks
     *
     * @return Task[]|array
     */
    public function active()
    {
        $active = Task::STATUS_ACTIVE;
        return $this->andWhere(['[[status]]'=> $active]);
    }

    /**
     * Find done Tasks
     *
     * @return Task[]|array
     */
    public function done()
    {
        $done = Task::STATUS_DONE;
        return $this->andWhere(['[[status]]' => $done]);
    }

    /**
     * Find Tasks on current week
     *
     * @return Task[]|array
     */
    public function onWeek()
    {
        $week = \date('W');
        return $this->andWhere(['WEEKOFYEAR([[end]])' => $week]);
    }

    /**
     * Find Tasks on current week
     *
     * @return Task[]|array
     */
    public function onMonth()
    {
        $month = \date('n');
        return $this->andWhere(['MONTH([[end]])' => $month]);
    }

    /**
     * Find overdue Tasks
     *
     * @return Task[]|array
     */
    public function overdue()
    {
        $date = \date('Y-m-d H:i');

        return $this
            ->andWhere(['<', '[[deadline]]', $date])
            ->andWhere(['[[end]]' => null])
            ->active();
    }

    /**
     * Find Task`s user by user $id
     *
     * @return Task[]|array
     */
    public function findUserTasks($id)
    {
        return $this->query
            ->orFilterWhere(['assignee_id' => $id])
            ->orFilterWhere(['teamlead_id' => $id]);
    }

    /**
     * Get Active Record for user and current month
     *
     * @param integer $userId User's ID
     *
     * @return array Of Task Active Record
     */
    public function getByCurrentMonth($userId)
    {
        return $this->findUserTasks($userId)
            ->andWhere(['MONTH([[deadline]])' => \date('n')]);
    }

    /**
     * {@inheritdoc}
     *
     * @return Task[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     *
     * @return Task|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
