<?php

namespace common\models\project;

use Yii;
use common\models\User;
use common\models\status\Status;
use common\models\task\Task;
use common\models\users_profile\UsersProfile;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "project".
 *
 * @property int $id
 * @property int $teamlead_id
 * @property int $status_id
 * @property string $description
 * @property string $start
 * @property string $deadline
 * @property string $end
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 * @property string $project_title
 *
 * @property Status $status
 * @property User $teamlead
 * @property Task[] $tasks
 */
class Project extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 1;
    const STATUS_ACTIVE = 10;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project';
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
            [
                'class' => BlameableBehavior::class,
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['teamlead_id', 'status_id'], 'integer'],
            [['description'], 'string'],
            [['start', 'deadline', 'end'], 'safe'],
            [['project_title'], 'string', 'max' => 65],
            [
                ['status_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Status::class,
                'targetAttribute' => ['status_id' => 'id'],
            ],
            ['status_id', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            [
                ['teamlead_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => User::class,
                'targetAttribute' => ['teamlead_id' => 'id'],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'teamlead_id' => Yii::t('app', 'Teamlead ID'),
            'status_id' => Yii::t('app', 'Status ID'),
            'description' => Yii::t('app', 'Description'),
            'start' => Yii::t('app', 'Start'),
            'deadline' => Yii::t('app', 'Deadline'),
            'end' => Yii::t('app', 'End'),
            'created_by' => Yii::t('app', 'Created by'),
            'updated_by' => Yii::t('app', 'Updated by'),
            'created_at' => Yii::t('app', 'Created at'),
            'updated_at' => Yii::t('app', 'Updated at'),
            'project_title' => Yii::t('app', 'Project`s title'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(
            Status::class,
            ['id' => 'status_id']
        )->inverseOf('projects');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatusName()
    {
        return $this->getStatus()->select(['statusName' => 'status_name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeamlead()
    {
        return $this->hasOne(User::class, ['id' => 'teamlead_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserTeamGroup()
    {
        return $this->hasOne(
            UserTeamGroup::class,
            ['user_id' => 'teamlead_id']
        );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeamleadProfile()
    {
        return $this->hasOne(UsersProfile::class, ['user_id' => 'teamlead_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::class, ['project_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ProjectQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjectQuery(get_called_class());
    }

    /**
     * Return array like [1 => 'Project title #1', ..]
     *
     * @return Array
     */
    public function getProjectsArray()
    {
        return ArrayHelper::map(
            self::find()
            ->all(),
            'id',
            'project_title'
        );
    }
}
