<?php

namespace frontend\models;

use backend\models\Profile;
use common\models\User;
use Exception;
use Yii;
use yii\base\Model;

/**
 * Signup form
 */
class SignupForm extends Model {

   public $username;
   public $email;
   public $password;
   public $password_repeat;
   public $gender;
   public $terms;
   public $verifyCode;

   // public $btime;

   /**
    * @inheritdoc
    */
   public function rules() {
      return [
          ['username', 'filter', 'filter' => 'trim'],
          ['username', 'required'],
          ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Это имя пользователя уже используеться.'],
          // ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
          ['username', 'string', 'min' => 2, 'max' => 255],
          ['email', 'filter', 'filter' => 'trim'],
          ['email', 'required'],
          ['email', 'email'],
          ['email', 'string', 'max' => 255],
          ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Это емайл адрес уже используеться.'],
          // ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
          ['password', 'required'],
          ['password', 'string', 'min' => 6],
          ['password_repeat', 'required'],
          ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => Yii::t('app', 'Passwords don`t match')],
          // ['gender', 'required'],
          // ['gender', 'boolean'],
          ['terms', 'required', 'requiredValue' => 1, 'message' => Yii::t('app', 'You are not agreed with terms.')],
          // verifyCode needs to be entered correctly
          [['verifyCode'], 'captcha', 'captchaAction' => 'site/captcha'],
              // ['btime', 'required'],
              // // ensure empty values are stored as NULL in the database
              // ['btime', 'default', 'value' => null],
              // // validate the date and overwrite `btime` with the unix timestamp
              // ['btime', 'date', 'timestampAttribute' => 'btime'],
      ];
   }

   /**
    * @inheritdoc
    */
   public function attributeLabels() {
      return [
          'username' => Yii::t('app', 'Username'),
          'password' => Yii::t('app', 'Password'),
          'password_repeat' => Yii::t('app', 'Password repeat'),
          'email' => Yii::t('app', 'Email'),
          // 'gender' => Yii::t('app', 'Gender'),
          'terms' => Yii::t('app', 'Terms'),
          'verifyCode' => 'Код проверки',
      ];
   }

   /**
    * Signs user up.
    *
    * @return User|null the saved model or null if saving fails
    */
   public function signup() {
      if (!$this->validate()) {
         return null;
      }

      $user = new User();
      $user->username = $this->username;
      $user->email = $this->email;
      $user->setPassword($this->password);
      $user->generateAuthKey();

      $profile = new Profile;
      $profile->gender = 1; //$this->gender;     
      $profile->btime = time() - 100000000;




      $transaction = Yii::$app->db->beginTransaction();
      try {
         $user->save(false);
         $profile->user_id = $user->id;
         $profile->save(false);
         $transaction->commit(); // commit transaction
      } catch (Exception $e) {
         $transaction->rollBack();
         throw $e;
      }

//        $isValid = $user->validate();
//        $isValid = $profile->validate() && $isValid;
//        if ($isValid) {
//            $user->save(false);
//            $profile->save(false);
      return $user;
//        }
//        return null;
   }

}
