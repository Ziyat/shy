<?php

namespace backend\controllers;

use backend\models\Articles;
use backend\models\Pages;
use backend\models\PagesSearch;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * PagesController implements the CRUD actions for Pages model.
 */
class PagesController extends Controller {

   public function behaviors() {
      return [
          'access' => [
              'class' => AccessControl::className(),
              'rules' => [
                  [
//                        'actions' => ['logout', 'index'],
                      'allow' => true,
                      'roles' => ['@'],
                  ],
              ],
          ],
          'verbs' => [
              'class' => VerbFilter::className(),
              'actions' => [
                  'delete' => ['post'],
              ],
          ],
      ];
   }

   /**
    * Lists all Pages models.
    * @return mixed
    */
   public function actionIndex() {
      $searchModel = new PagesSearch();
      $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

      return $this->render('index', [
                  'searchModel' => $searchModel,
                  'dataProvider' => $dataProvider,
      ]);
   }

   /**
    * Displays a single Pages model.
    * @param integer $id
    * @return mixed
    */
   public function actionView($id) {
      $searchModel = new PagesSearch();
      return $this->render('view', [
                  'model' => $this->findModel($id),
                  'searchModel' => $searchModel,
      ]);
   }

   /**
    * Creates a new Pages model.
    * If creation is successful, the browser will be redirected to the 'view' page.
    * @return mixed
    */
   public function actionCreate() {
      $model = new Pages();
      if ($model->load(Yii::$app->request->post())) {
         Pages::typeFilter($model);
         if ($model->save()) {
            if ($model->type == Pages::TYPE_PAGE && $this->articleSave($model))
               return $this->redirect(['view', 'id' => $model->id]);
         }
      }

      return $this->render('create', [
                  'model' => $model,
                  'modelFull' => Pages::find()->where(['lang_id' => $model->lang_id])->all(),
                  'article' => new Articles(),
      ]);
   }

   /**
    * Updates an existing Pages model.
    * If update is successful, the browser will be redirected to the 'view' page.
    * @param integer $id
    * @return mixed
    */
   public function actionUpdate($id) {
      $model = $this->findModel($id);
      if ($model->load(Yii::$app->request->post())) {
         Pages::typeFilter($model);
         if ($model->save()) {
            if ($model->type == Pages::TYPE_PAGE)
               $this->articleSave($model, $id);

            return $this->redirect(['view', 'id' => $model->id]);
         }
      }
      $article = $model->type == Pages::TYPE_PAGE ? Articles::find()->where(['parent_id' => $id])->one() : new Articles();
      return $this->render('update', [
                  'model' => $model,
                  'modelFull' => Pages::find()->where(['lang_id' => $model->lang_id])->all(),
                  'article' => $article,
      ]);
   }

   private function articleSave($model, $id = null) {
      $article = $id ? Articles::find()->where(['parent_id' => $id])->one() : new Articles();
      if ($article->load(Yii::$app->request->post())) {
         $article->lang_id = $model->lang_id;
         $article->parent_id = $model->id;
         $article->title = $model->title;
         $article->alias = $model->alias;
//            $article->text = $model->text;
         $article->is_page = 1;
         $article->is_public = $model->is_public;
         if ($article->save(false))
            return true;
      }
      return false;
   }

   /**
    * Deletes an existing Pages model.
    * If deletion is successful, the browser will be redirected to the 'index' page.
    * @param integer $id
    * @return mixed
    */
   public function actionDelete($id) {
      if ($id != 172 && $id != 173) {
         $model = $this->findModel($id);
         if ($model->type == Pages::TYPE_PAGE) {
            $article = Articles::find()->where(['parent_id' => $id])->one();
            $article->delete();
         }
         $model->delete();
      }
      return $this->redirect(['index']);
   }

   /**
    * Finds the Pages model based on its primary key value.
    * If the model is not found, a 404 HTTP exception will be thrown.
    * @param integer $id
    * @return Pages the loaded model
    * @throws NotFoundHttpException if the model cannot be found
    */
   protected function findModel($id, $modelname = false) {
      if (!$modelname)
         $modelname = new Pages();
      if (($model = $modelname::findOne(['id' => $id])) !== null)
         return $model;
      else
         throw new NotFoundHttpException('The requested page does not exist.');
   }

   public function actionLangChange($id) {
      if (($model = Pages::find()->where(['and', ['lang_id' => $id], ['or', 'parent_id=0', 'type=8']])->all()) !== null) {
// echo '<pre>'.var_dump(yii\helpers\ArrayHelper::map($model, 'id', 'title'));die;
         $str = '';
         foreach (ArrayHelper::map($model, 'id', 'title') as $key => $val) {
            $str .= "<option value='$key'>$val</option>";
         }
         return $str;
      } else {
         throw new NotFoundHttpException('The requested page does not exist.');
      }
   }

}
