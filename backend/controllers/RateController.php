<?php

namespace backend\controllers;

use box\entities\rate\Rate;
use box\forms\rate\RateForm;
use box\repositories\reads\RateReadRepository;
use box\repositories\reads\UserReadRepository;
use box\searches\RateSearch;
use box\services\manage\rate\RateManageService;
use Yii;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

/**
 * RateController implements the CRUD actions for Rate model.
 * @property RateReadRepository $rates
 * @property UserReadRepository $users
 * @property RateManageService $manage
 */
class RateController extends CommonController
{
    public $rates;
    public $manage;

    public function __construct(
        string $id,
        $module,
        UserReadRepository $userReadRepository,
        RateReadRepository $rateReadRepository,
        RateManageService $rateManageService,
        array $config = []
    )
    {
        $this->rates = $rateReadRepository;
        $this->manage = $rateManageService;
        parent::__construct($id, $module, $userReadRepository, $config);
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        if (!Yii::$app->user->isGuest) {
            Yii::$app->view->params['user'] = $this->users->find(Yii::$app->user->getId());
        }
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * @return string
     * @throws \yii\base\InvalidArgumentException
     */
    public function actionIndex()
    {
        $searchModel = new RateSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     * @throws \yii\base\InvalidArgumentException
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * @return string|\yii\web\Response
     * @throws \yii\base\InvalidArgumentException
     */
    public function actionCreate()
    {
        $form = new RateForm;
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $id = $this->manage->create($form);
                Yii::$app->session->setFlash('success', 'Тариф успешно создан!');
                return $this->redirect(['view', 'id' => $id]);
            } catch (\Exception $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('create', [
            'model' => $form,
        ]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     * @throws \yii\base\InvalidArgumentException
     */
    public function actionUpdate($id)
    {
        $rate = $this->rates->find($id);
        $form = new RateForm($rate);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->manage->update($rate, $form);
                Yii::$app->session->setFlash('success', 'Тариф успешно создан!');
                return $this->redirect(['view', 'id' => $rate->id]);
            } catch (\Exception $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('update', [
            'model' => $form,
        ]);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Rate model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Rate the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Rate::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
