<?php

namespace common\rbac;

use Yii;
use yii\rbac\Rule;
use common\models\User;
use common\models\group\Group;

/**
 * Check if userId in admin group
 */
class UserGroupRule extends Rule
{
    public $name = 'whichUserGroup';

    /**
     * @param string|int $userID the user ID.
     * @param Item $item the role or permission that this rule is associated with.
     * @param array $params parameters passed to ManagerInterface::checkAccess()
     * ['user_team_group' => $userTeamGroup].
     *
     * @return bool a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($userID, $item, $params)
    {
        if (!Yii::$app->user->isGuest) {
            $groupID = $this->getUserTeamGroup()->group_id;

            if ($item->name === Group::ADMIN) {
                return $groupID == User::GROUP_ADMIN_ID;
            } elseif ($item->name === Group::TEAMLEAD) {
                return $groupID == User::GROUP_TEAMLEAD_ID;
            } elseif ($item->name === Group::ASSIGNEE) {
                return $groupID == User::GROUP_ASSIGNEE_ID;
            } else {
                return $groupID == User::GROUP_USER_ID;
            }
        }

        return false;
    }

    /**
     * Return current user UserTeamGroup object
     *
     * @return User|null
     */
    protected function getUserTeamGroup()
    {
        return Yii::$app->user->identity->userTeamGroup;
    }
}
