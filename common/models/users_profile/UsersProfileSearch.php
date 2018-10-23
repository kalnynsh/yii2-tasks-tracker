<?php

namespace common\models\users_profile;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\users_profile\UsersProfile;

/**
 * UsersProfileSearch represents the model behind the search form of `common\models\users_profile\UsersProfile`.
 */
class UsersProfileSearch extends UsersProfile
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'sex', 'status'], 'integer'],
            [['first_name', 'last_name', 'specialization', 'birthday', 'phone', 'image', 'country', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = UsersProfile::find()->active();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'sex' => $this->sex,
            'birthday' => $this->birthday,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'specialization', $this->specialization])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'country', $this->country]);

        return $dataProvider;
    }
}
