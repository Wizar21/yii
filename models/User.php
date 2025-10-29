<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{

    public function rules()
    {
        return [
            [['login', 'name', 'email', 'password', 'phone', 'birth'], 'required'],
            ['login', 'match', 'pattern' => '/^[a-z\d\-]+$/', 'message' => 'Только латиница, цифры, тире'],
            ['login', 'string', 'max' => 255],
            ['name', 'string', 'min' => 3, 'max' => 32],
            ['name', 'match', 'pattern' => '/^[а-яА-ЯёЁa-zA-Z\s]+$/u', 'message' => 'Имя может содержать только русские буквы'],
            ['email', 'email'],
            ['phone', 'match', 'pattern' => '/^\+?[\d\s]{10,15}$/', 'message' => 'Телефон должен быть в формате +1234567890 или 1234567890'],
            ['birth', 'integer', 'min' => 1900, 'max' => 2025],
            ['address', 'string', 'max' => 1000],
        ];
    }
    public static function tableName()
    {
        return 'user'; 
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne($id); 
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null; 
    }

    /**
     * Finds user by username
     *
     * @param string 
     * @return static|null
     */
    public static function findByUsername($login)
    {
        return static::findOne(['login' => $login]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id; 
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key; 
    }

    /**
     * {@inheritdoc}
     */

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey; 
    }

    /**
     * Validates password
     *
     * @param string 
     * @return bool 
     */
    public function validatePassword($password)
    {
        return password_verify($password, $this->password);
    }

    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }
}