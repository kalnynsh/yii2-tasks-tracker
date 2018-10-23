<?php

namespace frontend\modules\v1\models\task;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class TaskRestSearch extends TaskRest
{
    public function rules()
    {
        return [
            [
                [
                    'title',
                    'assignee_id',
                    'teamlead_id',
                    'start',
                    'deadline',
                    'status',
                    'projectTitle',
                    'teamleadName',
                    'assigneeName',
                ],
                'safe',
            ]
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    /**
     * Search method
     *
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = TaskRest::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, '');

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'assignee_id', $this->assignee_id])
            ->andFilterWhere(['like', 'teamlead_id', $this->teamlead_id])
            ->andFilterWhere(['like', 'start', $this->start])
            ->andFilterWhere(['like', 'deadline', $this->deadline])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'projectTitle', $this->projectTitle])
            ->andFilterWhere(['like', 'teamleadName', $this->teamleadName])
            ->andFilterWhere(['like', 'assigneeName', $this->assigneeName]);

        return $dataProvider;
    }

    /**
     * Method return serach form name
     * ``s['title']``
     *
     * @return string
     */
    public function formName()
    {
        return 's';
    }
}
