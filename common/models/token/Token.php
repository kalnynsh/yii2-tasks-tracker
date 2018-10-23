<?php

namespace common\models\token;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use common\models\User;

/**
 * This is the model class for table "{{%post}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $expired_at
 * @property string $token
 */
class Token extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%token}}';
    }

    public function generateToken($expire)
    {
        $this->expired_at = $expire;
        $this->token = Yii::$app->security->generateRandomString();
    }

    public function fields()
    {
        return [
            'token' => 'token',
            'expired' => function () {
                return \date(DATE_RFC3339, $this->expired_at);
            }
        ];
    }

    /**
     * Get user from relationship `user`
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(
            User::class,
            ['id' => 'user_id']
        );
    }
}
