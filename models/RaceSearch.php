<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Race;

/**
 * RaceSearch represents the model behind the search form about `app\models\Race`.
 */
class RaceSearch extends Race
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sport_id'], 'integer'],
            [['name', 'place', 'date', 'description', 'attachment1', 'attachment2', 'picture', 'status', 'creation_date'], 'safe'],
            [['cost'], 'number'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Race::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'sport_id' => $this->sport_id,
            'date' => $this->date,
            'cost' => $this->cost,
            'creation_date' => $this->creation_date,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'place', $this->place])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'attachment1', $this->attachment1])
            ->andFilterWhere(['like', 'attachment2', $this->attachment2])
            ->andFilterWhere(['like', 'picture', $this->picture])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
