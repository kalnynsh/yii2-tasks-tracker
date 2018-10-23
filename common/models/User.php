<?php
namespace common\models;

use Yii;
use yii\base\Event;
use yii\db\ActiveRecord;
use common\models\task\Task;
use common\models\group\Group;
use yii\web\IdentityInterface;
use common\models\project\Project;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use common\models\users_profile\UsersProfile;
use common\models\user_team_group\UserTeamGroup;
use common\components\new_user_group_behavior\NewUserGroupBehavior;
use common\components\new_user_profile_behavior\NewUserProfileBehavior;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 1;
    const STATUS_ACTIVE = 10;

    const GROUP_ADMIN_ID = 1;
    const GROUP_TEAMLEAD_ID = 2;
    const GROUP_ASSIGNEE_ID = 3;
    const GROUP_USER_ID = 4;

    const EVENT_NEW_USER_SIGNUP = 'new_user_signup';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            'NewUserGroupBehavior' => [
                'class' => NewUserGroupBehavior::class,
            ],
            'NewUserProfileBehavior' => [
                'class' => NewUserProfileBehavior::class,
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_DELETED, self::STATUS_ACTIVE]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::find()
            ->joinWith('token t')
            ->andWhere(['t.token' => $token])
            ->andWhere(['>', 't.expired_at', time()])
            ->one();
    }

    /**
     * Finds user by username
     *
     * @param string $username
     *
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     *
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     *
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * Get relationship with `task` table
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::class, ['assignee_id' => 'id']);
    }

    /**
     * Get relationship with `users_profile` table
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(UsersProfile::class, ['user_id' => 'id']);
    }

    /**
     * Get team from relationship with `user_team_group` table
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserTeamGroup()
    {
        return $this->hasOne(UserTeamGroup::class, ['user_id' => 'id']);
    }

    /**
     * Get team_name from relationship via `user_team_group` from `team` table
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTeamName()
    {
        return $this->hasOne(
            Team::class,
            ['id' => 'team_id']
        )->viaTable(
            'user_team_group',
            ['team_id' => 'id']
        );
    }

    /**
     * Get group_name from relationship via `user_team_group` from `group` table
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroupName()
    {
        return $this->hasOne(
            Group::class,
            ['id' => 'group_id']
        )->viaTable(
            'user_team_group',
            ['group_id' => 'id']
        );
    }

    /**
     * Get projects from relationship `projects`
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProjects()
    {
        return $this->hasMany(
            Project::class,
            ['teamlead_id' => 'id']
        )->inverseOf('teamlead');
    }

    /**
     * Get tokens from relationship `token`
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTokens()
    {
        return $this->hasMany(
            Token::class,
            ['user_id' => 'id']
        );
    }

    /**
     * After new User save
     *
     * @param mixed $insert
     * @param mixed $changedAttributes
     *
     * @return void
     */
    public function afterSave($insert, $changedAttributes)
    {
        $return = parent::afterSave($insert, $changedAttributes);
        $event = new Event();

        if ($insert) {
            $this->trigger(static::EVENT_NEW_USER_SIGNUP, $event);
        }

        return $return;
    }
}
