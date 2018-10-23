<?php

namespace common\models\user_team_group;

use Yii;
use common\models\User;
use common\models\team\Team;
use common\models\group\Group;
use common\models\users_profile\UsersProfile;

/**
 * This is the model class for table "user_team_group".
 *
 * @property int $id
 * @property int $user_id
 * @property int $group_id
 * @property int $team_id
 *
 * @property Group $group
 * @property Team $team
 * @property User $user
 */
class UserTeamGroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_team_group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'group_id', 'team_id'], 'integer'],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::class,
                'targetAttribute' => ['group_id' => 'id']],
            [['team_id'], 'exist', 'skipOnError' => true, 'targetClass' => Team::class,
                'targetAttribute' => ['team_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class,
                'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'group_id' => Yii::t('app', 'Group ID'),
            'team_id' => Yii::t('app', 'Team ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Group::class, ['id' => 'group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeam()
    {
        return $this->hasOne(Team::class, ['id' => 'team_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(
            User::class,
            ['id' => 'user_id']
        );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(
            UsersProfile::class,
            ['user_id' => 'user_id']
        );
    }

    /**
     * {@inheritdoc}
     * @return UserTeamGroupQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserTeamGroupQuery(get_called_class());
    }

    /**
     * Return array like [1 => 'Teamlead name, team name', ..]
     *
     * @return array
     */
    public function getTeamleadsArray()
    {
        $userTeamQuery = $this->find();

        $teamleadsObjects = $userTeamQuery
            ->with(['profile', 'team'])
            ->withTeamleadsIDs()
            ->limit(20)
            ->all();

        $teamleads = [];

        foreach ($teamleadsObjects as $teamlead) {
            $teamleads[$teamlead->user_id]
                = 'ID: ' . $teamlead->user_id . ', '
                . $teamlead->profile->first_name
                . ' ' . $teamlead->profile->last_name
                . ', team: `' . $teamlead->team->team_name . '`';
        }

        return $teamleads;
    }

    /**
     * Return array like [1 => 'Teamlead name, team name', ..]
     *
     * @return array
     */
    public function getAssigneesArray()
    {

        $userTeamQuery = $this->find();

        $assigneesObjects = $userTeamQuery
            ->with(['profile', 'team'])
            ->withAssigneesIDs()
            ->limit(20)
            ->all();

        $assignees = [];

        foreach ($assigneesObjects as $assignee) {
            $assigneeID = 'ID: ' . $assignee->user_id . ', ';
            $firstName = $assignee->profile ? $assignee->profile->first_name : 'Unknown';
            $lastName = $assignee->profile ? $assignee->profile->last_name : ' or not set';
            $fullName = $firstName. ' ' .  $lastName;

            $assignees[$assignee->user_id]
                = $assigneeID
                . ' '
                . $fullName
                . ', team: `' . $assignee->team->team_name . '`';
        }

        return $assignees;
    }
}
