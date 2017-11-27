<?php

namespace frontend\controllers;

use backend\models\Contact;
use Yii;
use yii\web\Controller;

/**
 * Site controller
 */
class SiteController extends Controller
{

   /**
    * @inheritdoc
    */
   public function actions()
   {
      return [
         'error' => [
            'class' => 'yii\web\ErrorAction',
         ],
         'captcha' => [
            'class' => 'yii\captcha\CaptchaAction',
         ],
      ];
   }

   /**
    * Displays homepage.
    *
    * @return mixed
    */
   public function actionIndex()
   {

      return $this->render('index', [
//            'films' => $this->findModels('films', Yii::$app->params['index-limit']),
      ]);
   }

    public function actionContact()
    {
        $model = new Contact();
        if ($model->load(Yii::$app->request->post())) {
//         if ($model->save() && $model->sendEmail(Yii::$app->params['supportEmail'])) {
            if ($model->save() && $model->sendEmail('a.abdualiym@gmail.com')) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }
            return $this->refresh();
        } else {
            return $this->render('contact', [
                        'model' => $model,
            ]);
        }
    }

}