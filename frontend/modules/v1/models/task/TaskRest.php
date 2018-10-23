<?php

namespace frontend\modules\v1\models\task;

use Yii;
use yii\web\Link;
use yii\helpers\Url;
use yii\web\Linkable;

/**
 * This model class extended from \common\models\task\Task
 *
 * @property int $id
 * @property string $title
 * @property int $assignee_id
 * @property int $teamlead_id
 * @property string $start
 * @property string $deadline
 * @property string $end
 * @property int $status
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 *
 * @property string $assigneeName
 * @property string $teamleadName
 * @property string $projectTitle
 */
class TaskRest extends \common\models\task\Task implements Linkable
{
    public $teamleadName;
    public $assigneeName;
    public $projectTitle;
    public $statusName;

    /**
     * Return array of fields
     *
     * @return array $fields
     */
    public function fields()
    {
        $fields = [
            'id',
            'title',
            'projectTitle' => function () {
                return $this->project->project_title;
            },
            'teamleadName' => function () {
                $firstName
                    = $this->teamlead->profile ? $this->teamlead->profile->first_name : 'Unknown';
                $lastName
                    = $this->teamlead->profile ? $this->teamlead->profile->last_name: 'or not set';

                return $firstName . ' ' . $lastName;
            },
            'assignee_id',
            'assigneeName' => function () {
                $firstName
                    = $this->assignee->profile ? $this->assignee->profile->first_name : 'Unknown';
                $lastName
                    = $this->assignee->profile ? $this->assignee->profile->last_name : 'or not set';

                return $firstName . ' ' . $lastName;
            },
            'start',
            'deadline',
            'statusName' => function () {
                return $this->getStatus();
            },
        ];

        return $fields;
    }

    /**
     * Return array of extraFields
     *
     * @return array $extraFields
     */
    public function extraFields()
    {
        $extraFields = [
            'status',
            'project_id',
            'teamlead_id',
            'end',
            'description',
            'created_at',
            'updated_at'
        ];

        return $extraFields;
    }

    public function getLinks()
    {
        return [
            Link::REL_SELF => Url::to(['task/view', 'id' => $this->id], true),
        ];
    }
}
