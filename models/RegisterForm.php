<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class RegisterForm extends Model
{
    public $username;
    public $email;
    public $surname;
    public $avatar;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [

        ];
    }

    public function login()
    {
        var_dump($this->validate());
//        die;
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }
}
