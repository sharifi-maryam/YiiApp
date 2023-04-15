<?php

namespace app\models;

use Faker\Guesser\Name;
use Yii;


class Car extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'car';
    }


    public function rules()
    {
        return [
            [['name', 'color'], 'string', 'max' => 255],
            [['name'], 'required'],
            [
                ['color'], 'required', 'when' => function () {
                    return $this->name == 'peride';
                }, 'whenClient' => "function (attribute, value) {
                    return ($('#name').val() == 'peride');
                }",
                //'enableClientValidation' => false,
                'message' => 'If "Peride" is selected, the color field cannot be empty.'
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'color' => 'Color',
        ];
    }
}
