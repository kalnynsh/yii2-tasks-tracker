<?php

namespace common\models\status;

use Yii;
use common\models\project\Project;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "status".
 *
 * @property int $id
 * @property string $status_name
 *
 * @property Project[] $projects
 */
class Status extends \yii\db\ActiveRecord
{
    /** @property array $statuses array of statuses */
    protected $statuses;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status_name'], 'required'],
            [['status_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'status_name' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjects()
    {
        return $this->hasMany(
            Project::class,
            ['status_id' => 'id']
        )->inverseOf('status');
    }

    /**
     * {@inheritdoc}
     * @return StatusQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StatusQuery(get_called_class());
    }

    /**
     * Return array of Statuses like [.., 10 => 'Active']
     *
     * @return array
     */
    public function getStatusesArray()
    {
        if (!$this->statuses) {
            $statusesObjectsArray = (new Status())->find()->all();
            $statuses = ArrayHelper::map($statusesObjectsArray, 'id', 'status_name');
            $this->statuses = $statuses;
        }

        return $this->statuses;
    }
}
