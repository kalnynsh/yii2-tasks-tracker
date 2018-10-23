<?php

namespace common\rbac;

use Yii;
use yii\rbac\Rule;
use common\models\User;

/**
 * Check if userId in admin group
 */
class ProfileRule extends Rule
{
    public $name = 'isProfileOwner';

    /**
     * @param string|int $user the user ID.
     * @param Item $item the role or permission that this rule is associated with.
     * @param array $params parameters passed to ManagerInterface::checkAccess().
     *
     * @return bool a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($userID, $item, $params)
    {
        if (!Yii::$app->user->isGuest) {
            return isset($params['profile']) ? $params['profile']->user_id == $userID : false;
        }

        return false;
    }
}
