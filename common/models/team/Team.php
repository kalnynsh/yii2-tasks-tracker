<?php

namespace common\models\team;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "team".
 *
 * @property int $id
 * @property string $team_name
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 *
 * @property UserTeamGroup[] $userTeamGroups
 */
class Team extends \yii\db\ActiveRecord
{
    /**
     * Default team ID for new user
     */
    const DEFAULT_TEAM_ID = 5;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'team';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['team_name'], 'string', 'max' => 50],
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
            'team_name' => Yii::t('app', 'Team Name'),
            'description' => Yii::t('app', 'Description'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserTeamGroups()
    {
        return $this->hasMany(
            UserTeamGroup::class,
            ['team_id' => 'id']
        );
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
            ['team_id' => 'id']
        );
    }

    /**
     * {@inheritdoc}
     * @return TeamQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TeamQuery(get_called_class());
    }
}
