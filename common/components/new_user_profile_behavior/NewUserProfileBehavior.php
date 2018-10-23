<?php

namespace common\components\new_user_profile_behavior;

use yii\base\Event;
use yii\base\Behavior;
use common\models\User;
use common\models\users_profile\UsersProfile;

/**
 * NewUserProfileBehavior behavior class for handling new user data
 */
class NewUserProfileBehavior extends Behavior
{
    /**
     * Discribe events
     *
     * @return array
     */
    public function events()
    {
        return [
            User::EVENT_NEW_USER_SIGNUP => 'newUserProfileHandler',
        ];
    }

    /**
     * Handler function for saving default profile`s data
     *
     * @param Event $event
     *
     * @return boolean
     */
    public function newUserProfileHandler(Event $event)
    {
        $newUserProfile = new UsersProfile();
        $newUserProfile->user_id = $event->sender->id;
        $newUserProfile->status = UsersProfile::STATUS_ACTIVE;
        $newUserProfile->sex = UsersProfile::DEFAULT_SEX;
        $newUserProfile->birthday = UsersProfile::DEFAULT_BIRTHDAY;
        $newUserProfile->phone = UsersProfile::DEFAULT_PHONE;
        $newUserProfile->country = UsersProfile::DEFAULT_COUNTRY;
        $newUserProfile->specialization = UsersProfile::DEFAULT_SPECIALIZATION;

        $username = $event->sender->username;
        $usernameArray = explode('_', $username);
        $newUserProfile->first_name = ucfirst($usernameArray[0]);
        $newUserProfile->last_name = ucfirst($usernameArray[1]);
        $newUserProfile->image = UsersProfile::DEFAULT_IMG;

        if (!$newUserProfile->validate()) {
            return null;
        }

        $newUserProfile->save();

        return true;
    }
}
