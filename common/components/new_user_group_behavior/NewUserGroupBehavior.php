<?php

namespace common\components\new_user_group_behavior;

use Yii;
use yii\base\Event;
use common\models\User;
use yii\base\Behavior;
use common\models\team\Team;
use common\models\user_team_group\UserTeamGroup;

/**
 * NewUserGroupBehavior behavior class for handling new user data
 */
class NewUserGroupBehavior extends Behavior
{
    /**
     * Discribe events
     *
     * @return array
     */
    public function events()
    {
        return [
            User::EVENT_NEW_USER_SIGNUP => 'newUserGroupHandler',
        ];
    }

    /**
     * Handler function for saving default group, team data
     *
     * @param Event $event
     *
     * @return boolean
     */
    public function newUserGroupHandler(Event $event)
    {
        $newUserData = new UserTeamGroup();
        $newUserData->user_id = $event->sender->id;
        $newUserData->group_id = User::GROUP_USER_ID;
        $newUserData->team_id = Team::DEFAULT_TEAM_ID;

        if (!$newUserData->validate()) {
            return null;
        }

        $newUserData->save();

        return true;
    }
}
