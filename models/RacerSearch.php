<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Racer;

/**
 * QuestionSearch represents the model behind the search form about `app\models\Question`.
 */
class RacerSearch extends Racer
{
    public function attributes()
	{
	    // add related fields to searchable attributes
	    return array_merge(parent::attributes(), ['user.name']);
	}
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','category_id'], 'integer'],
            [['user.name'], 'safe'],
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
        $query = Racer::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>['defaultOrder'=>['position_general'=>SORT_ASC]],
        ]);

        $dataProvider->sort->attributes['user.name'] = [
		    'asc' => ['user.name' => SORT_ASC],
		    'desc' => ['user.name' => SORT_DESC],
		];

        $query->joinWith(['user']);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
        ]);

        $name=$this->getAttribute('user.name');
        $words=explode(' ', $name);
        foreach ($words as $word) {
        	$query->andFilterWhere(['or',
        		['like','user.name', $word],
        		['like','user.lastname', $word],
        	]);
        }

        return $dataProvider;
    }
}
