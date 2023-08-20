<?php

namespace app\models;

use Yii;
use \yii\db\ActiveRecord;

/**
 * Summary of User
 */
class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * 
     * @return string
     */
    public static function tableName(): string
    {
        return 'user';
    }

    /**
     * Валидирует поля модели
     * @return array
     */
    public function rules(): array
    {
        return [
            [['first_name', 'last_name', 'email', 'auth_key'], 'required', 'message' => 'Поле обязательно для заполения'],
            ['email', 'email', 'message' => 'Email введен неверно'],
            ['access_token', 'unique', 'message' => 'Уже есть такое значение'],
            ['email', 'unique', 'message' => 'Email уже зарегистрирован'],

        ];
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * Генерирует рандомный AuthKey
     *
     * @return void
     */
    public function setAuthKey(): void
    {
        $this->auth_key = Yii::$app->getSecurity()->generateRandomString();
    }
}