<?php


namespace backend\controllers;


use box\repositories\reads\UserReadRepository;
use Yii;
use yii\web\Controller;

class CommonController extends Controller
{
    public $users;

    public function __construct(string $id, $module, UserReadRepository $userReadRepository, array $config = [])
    {
        $this->users = $userReadRepository;
        parent::__construct($id, $module, $config);
    }

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
}
