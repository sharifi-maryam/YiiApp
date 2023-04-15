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

    public $username;
    public $car_name;

    public function rules()
    {
        return [
            [['car_name', 'username'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = CarUserJunction::find()
            ->innerJoin('car', 'car.id = car_user_junction.car_id')
            ->innerJoin('user', 'user.id = car_user_junction.user_id');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);

        $query->andFilterWhere(['like', 'car.name', $this->car_name]);
        $query->andFilterWhere(['like', 'user.username', $this->username]);

        return $dataProvider;
    }
}
