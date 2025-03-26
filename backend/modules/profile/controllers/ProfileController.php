<?php

namespace backend\modules\profile\controllers;

use backend\modules\profile\actions\CreateProfileAction;
use backend\modules\profile\actions\GetProfileAction;
use backend\modules\profile\actions\UpdateProfileAction;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class ProfileController extends Controller
{

    public $defaultAction = 'profile';
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    // Всё закрыто для неавторизованных пользователей
                    [
                        'actions' => ['profile', 'create', 'update'],
                        'allow' => true,
                        'roles' => ['@'], // только для авторизованных
                    ],
                ],
                'denyCallback' => function($rule, $action) {
                    \Yii::$app->user->loginRequired();
                },
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'create' => ['post'],
                    'update' => ['post', 'put'],
                ],
            ],
        ];
    }


   public function actions(){
        return [
            'profile'=>GetProfileAction::class,
            'create'=>CreateProfileAction::class,
            'update'=>UpdateProfileAction::class,
        ];
   }

}