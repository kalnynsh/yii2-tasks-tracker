<?php

namespace common\models\task;

use Yii;
use yii\base\Model;
use common\models\task\Task;
use yii\data\ActiveDataProvider;
use common\models\task\TaskQuery;

/**
 * TaskSearch represents the model behind the search form of `app\models\task\Task`.
 */
class TaskSearch extends Task
{
    public $user_id;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['assignee_id', 'teamlead_id', 'status'], 'integer'],
            [
                [
                    'title',
                    'start',
                    'description',
                    'deadline',
                    'end',
                    'created_at',
                    'updated_at',
                ],
                'safe',
            ],
        ];
    }

    // public function attributes()
    // {
    //     // make depandency available for search
    //     return array_merge(parent::attributes(), ['user.first_name', 'user.last_name']);
    // }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied based on $user_id
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $this->user_id = Yii::$app->user->getId() ?: '1000';

        $query = (new TaskQuery(Task::class))->findUserTasks($this->user_id);

        $dataProvider = new ActiveDataProvider(
            [
                'query' => $query,
                'pagination' => [
                    'pageSize' => 10,
                ],
            ]
        );

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want
            // to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere(
            [
                'deadline' => $this->deadline,
                'title' => $this->title,
                'status' => $this->status,
            ]
        );

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['>=', 'start', $this->start])
            ->andFilterWhere(['<=', 'end', $this->end]);

        return $dataProvider;
    }
}
