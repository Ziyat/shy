<?php

namespace backend\models\user;

use Yii;
use yii\base\Model;

/**
 * Update User form
 */
class UpdateUserForm extends Model
{

   public $username;
   public $pass;
   private $_user;

   public function __construct($user, $config = [])
   {
      $this->_user = $user;
      $this->username = $user->username;
      parent::__construct($config);
   }

   /**
    * @inheritdoc
    */
   public function rules()
   {
      return [
         [['username'], 'required'],
         ['username', 'filter', 'filter' => 'trim'],
         ['username', 'unique', 'targetClass' => User::className(), 'message' => 'Это имя пользователя уже используеться.', 'filter' => ['<>', 'username', $this->username]],
         ['username', 'string', 'min' => 2, 'max' => 255],
         ['pass', 'string', 'min' => 6],
      ];
   }

   public function attributeLabels()
   {
      return [
         'username' => Yii::t('app', 'Username'),
         'pass' => Yii::t('app', 'Password'),
      ];
   }

}