<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CarUserJunction;

/**
 * CarUserJunctionSearch represents the model behind the search form of `app\models\CarUserJunction`.
 */
class CarUserJunctionSearch extends CarUserJunction
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'car_id', 'user_id'], 'integer'],
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


    public function search($params)
    {
        $query = CarUserJunction::find();

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
            'car_id' => $this->car_id,
            'user_id' => $this->user_id,
        ]);

        return $dataProvider;
    }
}
