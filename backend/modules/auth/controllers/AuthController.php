<?php

namespace backend\modules\auth\controllers;

use backend\modules\auth\actions\LoginAction;
use backend\modules\auth\actions\LogoutAction;
use backend\modules\auth\actions\SignUpAction;
use yii\filters\AccessControl;
use yii\filters\RateLimiter;
use yii\filters\VerbFilter;
use yii\web\Controller;
use Yii;
use yii\web\ForbiddenHttpException;

class AuthController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    // Доступ для гостей (неаутентифицированных пользователей)
                    [
                        'actions' => ['login', 'error', 'signup'],
                        'allow' => true,
                        'roles' => ['?'], // гость
                    ],

                    // Базовый доступ для всех аутентифицированных пользователей
                    [
                        'actions' => ['logout', 'error', 'profile'],
                        'allow' => true,
                        'roles' => ['@'], // любой аутентифицированный пользователь
                    ],

                    // Доступ только для обычных пользователей
                    [
                        'actions' => ['account', 'update-profile'],
                        'allow' => true,
                        'roles' => ['user'],
                        'roleParams' => function() {
                            return ['user' => Yii::$app->user->identity];
                        },
                    ],

                    // Доступ для работников (employee)
                    [
                        'actions' => ['index', 'view', 'employee-dashboard'],
                        'allow' => true,
                        'roles' => ['employee'],
                        'roleParams' => function() {
                            return ['user' => Yii::$app->user->identity];
                        },
                    ],

                    // Доступ только для администраторов
                    [
                        'actions' => ['create', 'update', 'delete', 'admin-panel', 'manage-users'],
                        'allow' => true,
                        'roles' => ['admin'],
                        'roleParams' => function() {
                            return ['user' => Yii::$app->user->identity];
                        },
                    ],
                ],
                // Обработка отказа в доступе
                'denyCallback' => function ($rule, $action) {
                    throw new ForbiddenHttpException('Доступ запрещен. У вас недостаточно прав.');
                },
            ],

            // Проверка HTTP методов
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                    'create' => ['post'],
                    'update' => ['post', 'put'],
                    'delete' => ['post', 'delete'],
                ],
            ],

            // Ограничение частоты запросов для предотвращения брутфорса
            'rateLimiter' => [
                'class' => RateLimiter::class,
                'only' => ['login', 'signup'],
            ],
        ];
    }

    public function actions()
    {
        return [
            'signup' => SignUpAction::class,
            'login' => LoginAction::class,
            'logout' => LogoutAction::class,
        ];
    }

    public function actionError()
    {
        $exception = \Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            return $this->render('error', ['exception' => $exception]);
        }
    }

}