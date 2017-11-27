<?php

namespace backend\controllers;

use backend\models\Log;
use backend\models\user\CreateUserForm;
use backend\models\user\EditBalansForm;
use backend\models\user\GiveWaterForm;
use backend\models\user\ManageTypeForm;
use backend\models\user\UpdateUserForm;
use backend\models\user\User;
use backend\models\user\UserSearch;
use backend\models\UserTree;
use Yii;
use yii\db\Transaction;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->id != $id) {
            throw new BadRequestHttpException('Faqat o`z profilingizni o`zgartirishingiz mumkin.');
        }
        $user = User::findOne($id);
        $form = new UpdateUserForm($user);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            if ($form->pass) {
                $user->setPassword($form->pass);
            }
            $user->username = $form->username;
            $user->generateAuthKey();
            if ($user->save(false)) {
                return $this->redirect(['view', 'id' => $user->id]);
            }
        }
        return $this->render('update-user', [
                    'model' => $form,
                    'id' => $id,
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateUser()
    {
        $form = new CreateUserForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $user = User::createUser($form);
            $user->save(false);
            return $this->redirect(['view', 'id' => $user->id]);
        }
        return $this->render('create', [
                    'model' => $form,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
//   public function actionDelete($id)
//   {
//      $this->findModel($id)->delete();
//
//      return $this->redirect(['index']);
//   }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
