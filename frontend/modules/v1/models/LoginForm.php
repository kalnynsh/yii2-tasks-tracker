<?php

namespace frontend\modules\v1\models;

use \common\models\token\Token;
use \common\models\User;
use yii\base\Model;

/**
 * Login Form
 */
class LoginForm extends Model
{
    public $username;
    public $password;

    private $_user;

    /**
     * @inhericdoc
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * @runkit_return_value_used() Token|null
     */
    public function auth()
    {
        if ($this->validate()) {
            $token = new Token();
            $token->user_id = $this->getUser()->id;
            $token->generateToken(time() + 3600 * 24);

            return $token->save() ? $token : null;
        } else {
            return null;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return  User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}
