<?php

namespace backend\modules\admin\controllers;

use backend\modules\admin\actions\DeleteProfileAction;
use backend\modules\admin\actions\DeleteUserAction;
use backend\modules\admin\actions\GetProfilesAction;
use backend\modules\admin\actions\GetUsersAction;
use backend\modules\admin\actions\UpdateProfileAction;
use backend\modules\admin\actions\UpdateUserAction;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;

class AdminController extends Controller
{

    public $layout = 'admin';
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
                'denyCallback' => function() {
                    throw new ForbiddenHttpException('You are not allowed to access this page.');
                }
            ]
        ];

    }
    public function actions()
    {
        return [

            'users'=>GetUsersAction::class,
            'update-user'=>UpdateUserAction::class,
            'delete-user'=>DeleteUserAction::class,

            'profiles'=>GetProfilesAction::class,
            'update-profile'=>UpdateProfileAction::class,
            'delete-profile'=>DeleteProfileAction::class,

        ];
    }
    public function actionIndex()
    {
        return $this->render('index');
    }

}