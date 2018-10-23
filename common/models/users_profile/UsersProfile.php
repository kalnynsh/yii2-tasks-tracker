<?php

namespace common\models\users_profile;

use Yii;
use yii\db\Expression;
use common\models\User;
use yii\behaviors\TimestampBehavior;
use common\models\user_team_group\UserTeamGroup;
use common\models\guest\Guest;

/**
 * This is the model class for table "users_profile".
 *
 * @property int $id
 * @property int $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $specialization
 * @property int $sex
 * @property string $birthday
 * @property string $phone
 * @property string $image
 * @property string $country
 * @property string $created_at
 * @property string $updated_at
 *  @property int $status
 *
 * @property User $user
 */
class UsersProfile extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 1;
    const STATUS_ACTIVE = 10;

    const DEFAULT_BIRTHDAY = '3000-01-01';
    const DEFAULT_SEX = 1;
    const DEFAULT_PHONE = '+00-000-000-00-01';
    const DEFAULT_COUNTRY = 'Not set';
    const DEFAULT_SPECIALIZATION = 'Not set';
    const DEFAULT_IMG = '10_man.jpg';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users_profile';
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
            [['user_id', 'sex', 'status'], 'integer'],
            [['birthday'], 'safe'],
            [['first_name', 'last_name', 'specialization'], 'string', 'max' => 124],
            [['phone'], 'string', 'max' => 50],
            [['image'], 'string', 'max' => 255],
            [['country'], 'string', 'max' => 64],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            [
                ['user_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => User::className(),
                'targetAttribute' => ['user_id' => 'id'],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Profile ID'),
            'user_id' => Yii::t('app', 'User`s ID'),
            'first_name' => Yii::t('app', 'First name'),
            'last_name' => Yii::t('app', 'Last name'),
            'specialization' => Yii::t('app', 'Specialization'),
            'sex' => Yii::t('app', 'Sex'),
            'birthday' => Yii::t('app', 'Birthday'),
            'phone' => Yii::t('app', 'Phone'),
            'image' => Yii::t('app', 'Image'),
            'country' => Yii::t('app', 'Country'),
            'created_at' => Yii::t('app', 'Created at'),
            'updated_at' => Yii::t('app', 'Updated at'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return UsersProfileQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UsersProfileQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeamGroup()
    {
        return $this->hasOne(UserTeamGroup::class, ['user_id' => 'user_id']);
    }

    /**
     * Return existing or created Profile
     * @return object UsersProfile
     */
    public function getProfile()
    {
        if (Yii::$app->user->isGuest) {
            $profile = new Guest();
        }

        if (!Yii::$app->user->isGuest) {
            $userId = Yii::$app->user->getId();
            $profile = (new UsersProfileQuery(UsersProfile::class))
                ->getByUserId($userId)
                ->active()
                ->one();

            if (!$profile) {
                $user = Yii::$app->user->identity;
                $profile = new UsersProfile();
                $profile->user_id = $userId;

                $first_name =  \substr($user->username, 0, strpos($user->username, '_'));
                $first_name = $first_name ? ucfirst($first_name) : 'Not set';
                $last_name =  \substr($user->username, strrpos($user->username, '_') + 1);
                $last_name = $last_name ? ucfirst($last_name) : 'Not set';

                $profile->first_name = $first_name;
                $profile->last_name = $last_name;

                $profile->specialization = UsersProfile::DEFAULT_SPECIALIZATION;
                $profile->sex = UsersProfile::DEFAULT_SEX;
                $profile->birthday = UsersProfile::DEFAULT_BIRTHDAY;
                $profile->phone = UsersProfile::DEFAULT_PHONE;
                $profile->country = UsersProfile::DEFAULT_COUNTRY;
                $profile->image = UsersProfile::DEFAULT_IMG;
                $profile->status = UsersProfile::STATUS_ACTIVE;

                if (!$profile->validate()) {
                    return null;
                }
                $profile->save();
            }
        }

        return $profile;
    }
}
