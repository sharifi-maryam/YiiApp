<?php

namespace app\models;

use dektrium\user\models\RegistrationForm as BaseRegistrationForm;
use Yii;
use dektrium\user\traits\ModuleTrait;



class RegistrationForm extends BaseRegistrationForm
{

    use ModuleTrait;

    public $username;
    public $email;
    public $phone;
    public $password;


    public static function tableName()
    {
        return 'user';
    }



    public function rules()
    {
        $user = $this->module->modelMap['User'];

        return [
            // username rules
            'usernameTrim'     => ['username', 'trim'],
            'usernameLength'   => ['username', 'string', 'min' => 3, 'max' => 255],
            'usernamePattern'  => ['username', 'match', 'pattern' => $user::$usernameRegexp],
            'usernameRequired' => ['username', 'required'],
            'usernameUnique'   => [
                'username',
                'unique',
                'targetClass' => $user,
                'message' => \Yii::t('user', 'This username has already been taken')
            ],
            // email rules
            'emailTrim'     => ['email', 'trim'],
            'emailRequired' => ['email', 'required'],
            'emailPattern'  => ['email', 'email'],
            'emailUnique'   => [
                'email',
                'unique',
                'targetClass' => $user,
                'message' => Yii::t('user', 'This email address has already been taken')
            ],
            // password rules
            'passwordRequired' => ['password', 'required', 'skipOnEmpty' => $this->module->enableGeneratingPassword],
            'passwordLength'   => ['password', 'string', 'min' => 6, 'max' => 72],

            // phone rules
            'phoneTrim'        => ['phone', 'trim'],

        ];
    }



    public function attributeLabels()
    {
        return [
            'email'    => Yii::t('user', 'Email'),
            'username' => Yii::t('user', 'Username'),
            'password' => Yii::t('user', 'Password'),
            'phone'    => Yii::t('user', 'Phone'),
        ];
    }
}
