<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;

/**
 * UserSearch represents the model behind the search form about `app\models\User`.
 */
class UserSearch extends User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'lastname', 'username', 'sex', 'birthdate', 'identity', 'cellphone', 'address', 'size', 'password', 'contact_name', 'contact_phone', 'insurance', 'policy', 'blood_type', 'medical_history', 'recent_injuries', 'surgeries', 'allergies', 'status', 'creation_date'], 'safe'],
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
        $query = User::find();

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
            'birthdate' => $this->birthdate,
            'creation_date' => $this->creation_date,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'lastname', $this->lastname])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'sex', $this->sex])
            ->andFilterWhere(['like', 'identity', $this->identity])
            ->andFilterWhere(['like', 'cellphone', $this->cellphone])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'size', $this->size])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'contact_name', $this->contact_name])
            ->andFilterWhere(['like', 'contact_phone', $this->contact_phone])
            ->andFilterWhere(['like', 'insurance', $this->insurance])
            ->andFilterWhere(['like', 'policy', $this->policy])
            ->andFilterWhere(['like', 'blood_type', $this->blood_type])
            ->andFilterWhere(['like', 'medical_history', $this->medical_history])
            ->andFilterWhere(['like', 'recent_injuries', $this->recent_injuries])
            ->andFilterWhere(['like', 'surgeries', $this->surgeries])
            ->andFilterWhere(['like', 'allergies', $this->allergies])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
