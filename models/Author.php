<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "author".
 *
 * @property integer $id
 * @property string $name
 * @property string $username
 * @property string $email
 * @property string $password
 */
class Author extends \yii\db\ActiveRecord implements IdentityInterface
{

    public $repassword;
    public $role;
    public $status;

    public static function isUserAdmin($id)
    {
        if (self::findOne(['id' => $id, 'role' => 2])){
            return true;
        } else {

            return false;
        }

    }

    public static function isUserSimple($id)
    {
        if (self::findOne(['id' => $id, 'role' => 1])){
            return true;
        } else {

            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'author';
    }



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'username', 'email', 'password'], 'string', 'max' => 255],
            [['name', 'username', 'email', 'password', 'repassword'], 'required',],
            ['email', 'email', 'message' => 'Incorrect email address'],
            [['email', 'username'], 'unique', 'targetClass' => 'app\models\Author'],
            [['name', 'username'], 'string', 'min' => 3, 'max' => 25],
            [['password'], 'string', 'min' => 5, 'max' => 30],
            [['name'], 'match', 'pattern' => '/^[a-zA-Z\s\-]+$/'],
            [['username', 'password'], 'match', 'pattern' => '/^[0-9a-zA-Z\s\-]+$/'],
            ['repassword', 'compare', 'compareAttribute' => 'password', 'message' => "Passwords don't match"],


        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
        ];


    }

    public function getAuthKey()
    {
    }

    public function getId()
    {
        return $this->id;
    }

    public function validateAuthKey($authKey)
    {
    }

    public static function findIdentity($id)
    {
        return self::findOne($id);
    }
    public static function findByUsername($username){

        return self::findOne(['username'=>$username]);
    }
    public function validatePassword($password){

        return $this->password === $password;
    }
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException();
    }


}
