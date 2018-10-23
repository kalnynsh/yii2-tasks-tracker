<?php

namespace common\models\users_profile;

use common\models\User;

/**
 * This is the ActiveQuery class for [[UsersProfile]].
 *
 * @see UsersProfile
 */
class UsersProfileQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere(['status' => User::STATUS_ACTIVE]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     *
     * @return static|null
     */
    public function getByUserId($userId)
    {
        return $this->andWhere(['user_id' => $userId]);
    }

    /**
     * {@inheritdoc}
     * @return UsersProfile[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return UsersProfile|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
