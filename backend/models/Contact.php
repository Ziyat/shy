<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "contacts".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $phone
 * @property string $text
 * @property integer $updated_at
 * @property integer $created_at
 *
 * @property Industries $industry0
 */
class Contact extends ActiveRecord {

   /**
    * @inheritdoc
    */
   public static function tableName() {
      return 'contact';
   }

   public $verifyCode;

   /**
    * @inheritdoc
    */
   public function rules() {
      return [
         [['first_name', 'last_name', 'email'], 'required'],
         [['text'], 'string'],
         [['first_name', 'last_name', 'email', 'phone'], 'string', 'max' => 50],
         [['email'], 'email'],
         ['verifyCode', 'captcha', 'captchaAction' => 'site/captcha'],
      ];
   }

   /**
    * @inheritdoc
    */
   public function attributeLabels() {
      return [
         'id' => Yii::t('app', 'ID'),
         'first_name' => Yii::t('app', 'First Name'),
         'last_name' => Yii::t('app', 'Last Name'),
         'email' => Yii::t('app', 'Email'),
         'phone' => Yii::t('app', 'Phone'),
         'text' => Yii::t('app', 'Text'),
         'updated_at' => Yii::t('app', 'Updated At'),
         'created_at' => Yii::t('app', 'Created At'),
         'verifyCode' => Yii::t('app', 'Verify Code'),
      ];
   }

   public function behaviors() {
      return [
         'timestamp' => [
            'class' => 'yii\behaviors\TimestampBehavior',
            'attributes' => [
               ActiveRecord::EVENT_BEFORE_INSERT => ['updated_at', 'created_at'],
               ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
            ],
         ],
      ];
   }

   public function sendEmail($email) {
      return Yii::$app->mailer->compose([
               'html' => 'contact-form-html',
               'text' => 'contact-form-text',
               ], [
               'model' => $this,
            ])
//                        ->setFrom([Yii::$app->params['noreplyEmail'] => Yii::$app->name . ' robot'])
            ->setFrom(['info@jfl-tashkent.uz' => 'jfl-tashkent site mailer'])
            ->setTo($email)
            ->setSubject(Yii::t('app', 'JFL-TASHKENT.uz SITE CONTACT FORM') . ': ' . Yii::$app->name)
            ->send();
   }

}
