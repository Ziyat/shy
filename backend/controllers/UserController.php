<?php

namespace backend\controllers;

use box\entities\user\User;
use box\forms\user\PhotosForm;
use box\forms\user\ProfileForm;
use box\forms\user\UserChangeParentForm;
use box\forms\user\UserCreateForm;
use box\repositories\reads\UserReadRepository;
use box\searches\UserSearch;
use box\services\manage\user\UserManageService;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;

/**
 * UserController implements the CRUD actions for User model.
 * @property UserReadRepository $users
 * @property UserManageService $manage
 */
class UserController extends CommonController
{
    public $manage;
    public $cache;
    public $dependency;

    public function __construct(
        string $id,
        $module,
        UserReadRepository $readRepository,
        UserManageService $userManageService,
        array $config = []
    )
    {
        $this->manage = $userManageService;
//        $this->cache = Yii::$app->cache;
//        $this->dependency = new \yii\caching\DbDependency(['sql' => 'SELECT MAX(updated_at) FROM ' . User::tableName()]);
        parent::__construct($id, $module, $readRepository, $config);
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
     * @return string
     * @throws \yii\base\InvalidArgumentException
     */
    public function actionIndex()
    {
        $id = Yii::$app->user->getId();
        $searchModel = new UserSearch($id);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $id
     * @return string
     * @throws \yii\base\InvalidArgumentException
     */
    public function actionView($id)
    {

        $user = $this->users->find($id);

        return $this->render('view', [
            'user' => $user,

        ]);
    }

    /**
     * @param $id
     * @return string
     * @throws \yii\base\InvalidArgumentException
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionDocuments($id)
    {
        $document = new PhotosForm();
        $user = $this->users->find($id);
        if ($document->load(Yii::$app->request->post()) && $document->validate()) {
            try {
                $this->manage->addPhotos($id, $document);
                Yii::$app->session->setFlash('success', "Документы успешно добавлены.");
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('documents', compact('user','document'));
    }

    /**
     * @return string|\yii\web\Response
     * @throws \yii\base\InvalidArgumentException
     */
    public function actionCreate()
    {
        $form = new UserCreateForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $id = $this->manage->create($form);
                Yii::$app->session->setFlash('success', 'Успешно создан');
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
     * @throws \yii\base\InvalidArgumentException
     */
    public function actionUpdate($id)
    {
        $user = $this->users->find($id);
        $form = new ProfileForm($user->profile);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->manage->update($user, $form);
                Yii::$app->session->setFlash('success', 'Успешно редактирован');
                return $this->redirect(['view', 'id' => $user->id]);
            } catch (\Exception $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('update', [
            'user' => $user,
            'model' => $form,
        ]);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     * @throws \Throwable
     */
    public function actionDelete($id)
    {
        try {
            $this->manage->remove($id);
        } catch (\Exception $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }

    /**
     * @throws \yii\base\InvalidArgumentException
     */
    public function actionGenealogy()
    {
        $user = User::findOne(Yii::$app->user->getId());
        return $this->render('genealogy', [
            'users' => $user->getDescendants()->with('profile')->orderBy('lft')->all(),
            'main' => $user,
        ]);
    }

    /**
     * @param $from
     * @param $to
     * @return string
     * @throws \yii\base\InvalidArgumentException
     */
    public function actionChangeParent($from, $to)
    {
        $model = new UserChangeParentForm();
        try {
            $this->manage->changeParent($from, $to);
            $this->redirect(['genealogy']);
        } catch (\Exception $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->render('view', [
            'user' => $this->users->find($from),
            'model' => $model,
        ]);
    }


    /**
     * @param $id
     * @param $rate_id
     */
    public function actionSetRate($id, $rate_id)
    {
        try {
            $this->manage->setRate($id, $rate_id);
            Yii::$app->session->setFlash('success', 'Тариф успешно установлен.');
        } catch (\Exception $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        $this->redirect(['view', 'id' => $id]);
    }
}
