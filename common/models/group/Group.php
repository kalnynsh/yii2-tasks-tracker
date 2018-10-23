<?php

namespace common\models\group;

use Yii;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "group".
 *
 * @property int $id
 * @property string $group_name
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 *
 * @property UserTeamGroup[] $userTeamGroups
 */
class Group extends \yii\db\ActiveRecord
{
    /** Default goups names */
    const ADMIN = 'admin';
    const TEAMLEAD = 'teamlead';
    const ASSIGNEE = 'assignee';
    const USER = 'user';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'group';
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
            [['group_name'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'group_name' => Yii::t('app', 'Group name'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserTeamGroups()
    {
        return $this->hasMany(UserTeamGroup::className(), ['group_id' => 'id']);
    }

    /**
     * Get users from relationship via `user_team_group` from `user` table
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(
            User::class,
            ['id' => 'user_id']
        )->viaTable(
            'user_team_group',
            ['group_id' => 'id']
        );
    }

    /**
     * {@inheritdoc}
     * @return GroupQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GroupQuery(get_called_class());
    }
}
