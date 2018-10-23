<?php

namespace common\models\user_team_group;

use common\models\User;

/**
 * This is the ActiveQuery class for [[UserTeamGroup]].
 *
 * @see UserTeamGroup
 */
class UserTeamGroupQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return UserTeamGroup[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return UserTeamGroup|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function withTeamleadsIDs()
    {
        return $this->andWhere(['user_team_group.group_id' => User::GROUP_TEAMLEAD_ID]);
    }

    public function withAssigneesIDs()
    {
        return $this->andWhere(['user_team_group.group_id' => User::GROUP_ASSIGNEE_ID]);
    }

    public function withTeamleadProfileTeam()
    {
        return $this->with(['user', 'team']);
    }

    public function joinWithUserProfile()
    {
        return $this->leftJoin(
            'users_profile',
            'users_profile.user_id = user_team_group.user_id'
        );
    }

    public function joinWithTeam()
    {
        return $this->leftJoin(
            'team',
            'team.id = user_team_group.team_id'
        )->select('team_name');
    }
}
