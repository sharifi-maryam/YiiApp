<?php

namespace app\models;

use dektrium\user\models\User as BaseUser;
use yii\helpers\ArrayHelper;



class User extends BaseUser
{

    public function attributeLabels()
    {
        return [
            'username'          => \Yii::t('user', 'Username'),
            'email'             => \Yii::t('user', 'Email'),
            'registration_ip'   => \Yii::t('user', 'Registration ip'),
            'unconfirmed_email' => \Yii::t('user', 'New email'),
            'password'          => \Yii::t('user', 'Password'),
            'created_at'        => \Yii::t('user', 'Registration time'),
            'last_login_at'     => \Yii::t('user', 'Last login'),
            'confirmed_at'      => \Yii::t('user', 'Confirmation time'),
            'phone'             => \yii::t('user',  'Phone Number'),
        ];
    }


    public function scenarios()
    {
        $scenarios = parent::scenarios();
        return ArrayHelper::merge($scenarios, [
            'register' => ['username', 'email', 'password', 'phone'],
            'connect'  => ['username', 'email'],
            'create'   => ['username', 'email', 'password'],
            'update'   => ['username', 'email', 'password'],
            'settings' => ['username', 'email', 'password'],
        ]);
    }


    public function rules()
    {
        return [
            // username rules
            'usernameTrim'     => ['username', 'trim'],
            'usernameRequired' => ['username', 'required', 'on' => ['register', 'create', 'connect', 'update']],
            'usernameMatch'    => ['username', 'match', 'pattern' => static::$usernameRegexp],
            'usernameLength'   => ['username', 'string', 'min' => 3, 'max' => 255],
            'usernameUnique'   => [
                'username',
                'unique',
                'message' => \Yii::t('user', 'This username has already been taken')
            ],

            // email rules
            'emailTrim'     => ['email', 'trim'],
            'emailRequired' => ['email', 'required', 'on' => ['register', 'connect', 'create', 'update']],
            'emailPattern'  => ['email', 'email'],
            'emailLength'   => ['email', 'string', 'max' => 255],
            'emailUnique'   => [
                'email',
                'unique',
                'message' => \Yii::t('user', 'This email address has already been taken')
            ],

            // password rules
            'passwordRequired' => ['password', 'required', 'on' => ['register']],
            'passwordLength'   => ['password', 'string', 'min' => 6, 'max' => 72, 'on' => ['register', 'create']],

            // phone rules
            'phoneTrim'        => ['email', 'trim'],

        ];
    }
}
