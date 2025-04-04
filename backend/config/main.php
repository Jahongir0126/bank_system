<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'user' => [
            'class' => 'backend\modules\user\Module',
        ],
        'auth' => [
            'class' => 'backend\modules\auth\Module',
        ],
        'profile' => [
            'class' => 'backend\modules\profile\Module',
        ],
        'employee' => [
            'class' => 'backend\modules\employee\Module',
        ],
        'client' => [
            'class' => 'backend\modules\client\Module',
        ],
        'admin' => [
            'class' => 'backend\modules\admin\Module',
        ],

    ],
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],

        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'auth/login' => 'auth/auth/login',
                'auth/signup' => 'auth/auth/signup',
                'auth/logout' => 'auth/auth/logout',

                'profile' => 'profile/profile/profile',
                'profile/create' => 'profile/profile/create',
                'profile/update' => 'profile/profile/update',

                '/admin' => 'admin/admin/index',

                'admin/users' => 'admin/admin/users',
                'admin/delete-user' => 'admin/admin/delete-user',

                'admin/profiles' => 'admin/admin/profiles',
                'admin/profile' => 'admin/admin/show-profile',
                'admin/update-profile' => 'admin/admin/update-profile',
                'admin/delete-profile' => 'admin/admin/delete-profile',

            ],
        ],

    ],
    'params' => $params,
];
