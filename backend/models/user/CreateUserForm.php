<?php

namespace backend\models\user;

use Yii;
use yii\base\Model;

/**
 * Create User form
 */
class CreateUserForm extends Model
{

    public $fio;
    public $username;
    public $password;
    public $parent_id;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password', 'fio', 'parent_id'], 'required'],
            ['parent_id', 'integer'],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['parent_id' => 'id']],
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'unique', 'targetClass' => User::className(), 'message' => 'This username is already taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            // password is validated by validatePassword()
            ['password', 'string', 'min' => 6],
            ['fio', 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'parent_id' => Yii::t('app', 'Parent id'),
            'username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password'),
            'fio' => Yii::t('app', 'FIO'),
        ];
    }
}
