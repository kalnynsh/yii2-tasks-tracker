<?php

namespace common\models\task;

use Yii;
use yii\db\Expression;
use common\models\User;
use common\models\project\Project;
use frontend\models\comment\Comment;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "task".
 *
 * @property int    $id
 * @property string $title
 * @property int    $assignee_id
 * @property int    $teamlead_id
 * @property string $start
 * @property string $deadline
 * @property string $end
 * @property int    $status
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User   $assignee
 * @property User   $teamlead
 */
class Task extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 1;
    const STATUS_DONE = 2;
    const STATUS_CANCELLED = 3;
    const STATUS_TEST = 4;
    const STATUS_BUGFIX = 5;
    const STATUS_REVIEW = 6;
    const STATUS_ACTIVE = 10;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['assignee_id', 'teamlead_id', 'status'], 'integer'],
            [['start', 'deadline', 'end',], 'safe'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 124],
            [['assignee_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class,
                'targetAttribute' => ['assignee_id' => 'id']],
            [['teamlead_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class,
                'targetAttribute' => ['teamlead_id' => 'id']],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'assignee_id' => Yii::t('app', 'Assignee ID'),
            'teamlead_id' => Yii::t('app', 'Teamlead ID'),
            'start' => Yii::t('app', 'Start'),
            'deadline' => Yii::t('app', 'Deadline'),
            'end' => Yii::t('app', 'End'),
            'status' => Yii::t('app', 'Status'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * Get relationship from user table
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAssignee()
    {
        return $this->hasOne(User::class, ['id' => 'assignee_id']);
    }

    /**
     * Get relationship from user table
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTeamlead()
    {
        return $this->hasOne(User::class, ['id' => 'teamlead_id']);
    }

    /**
     * Get relationship from comment table
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::class, ['task_id' => 'id']);
    }

    /**
     * Return status of current task
     *
     * @return string
     */
    public function getStatus()
    {
        $status = '';

        if ($this->status === self::STATUS_ACTIVE) {
            $status = 'Active';
        } elseif ($this->status === self::STATUS_DELETED) {
            $status = 'Deleted';
        } elseif ($this->status === self::STATUS_CANCELLED) {
            $status = 'Cancelled';
        } elseif ($this->status === self::STATUS_REVIEW) {
            $status = 'Review';
        } elseif ($this->status === self::STATUS_BUGFIX) {
            $status = 'Bugfix stage';
        } elseif ($this->status === self::STATUS_TEST) {
            $status = 'Testing stage';
        } elseif ($this->status === self::STATUS_DONE) {
            $status = 'Done';
        }

        return $status;
    }

    /**
     * Return status of current task
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(
            Project::class,
            ['id' => 'project_id']
        )->inverseOf('tasks');
    }
}
