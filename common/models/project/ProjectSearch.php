<?php

namespace common\models\project;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\project\Project;

class ProjectSearch extends Project
{
    public function attributes()
    {
        return array_merge(
            parent::attributes(),
            [
                'status.status_name',

            ]
        );
    }

    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['project_title'], 'string'],
            [['start', 'deadline', 'end', 'status.status_name'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Project::find();
        
        $query->joinWith(['status', 'tasks']);
        $query->joinWith(['teamleadProfile']);

        $dataProvider = new ActiveDataProvider(
            [
                'query' => $query,
            ]
        );

        $dataProvider->sort->attributes['status.status_name'] = [
            'asc' => [
                'status.status_name' => SORT_ASC
            ],
            'desc' => [
                'status.status_name' => SORT_DESC
            ],
        ];

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $querey->andFilterWhere(['id' => $this->id]);
        $querey->andFilterWhere(['like', 'project_title', $this->project_title])
            ->andFilterWhere(['like', 'status.status_name', $this->getAttribute('status.status_name')])
            ->andFilterWhere(['like', 'start', $this->start])
            ->andFilterWhere(['like', 'deadline', $this->deadline])
            ->andFilterWhere(['like', 'end', $this->end]);

        return $dataProvider;
    }
}
