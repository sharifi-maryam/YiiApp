<?php

namespace app\models;

use Yii;


class CarUserJunction extends \yii\db\ActiveRecord
{


    public static function tableName()
    {
        return 'car_user_junction';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['car_id', 'user_id'], 'required'],
            [['car_id', 'user_id'], 'integer'],
            [['car_id', 'user_id'], 'unique', 'targetAttribute' => ['car_id', 'user_id']],
            [['car_id'], 'exist', 'skipOnError' => true, 'targetClass' => Car::class, 'targetAttribute' => ['car_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'car_id' => 'Car',
            'user_id' => 'User',
        ];
    }


    public function getCar()
    {
        return $this->hasOne(Car::class, ['id' => 'car_id']);
    }


    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
