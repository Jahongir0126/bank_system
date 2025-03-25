<?php

namespace backend\modules\auth\actions;

use backend\modules\user\models\User;
use yii\base\Action;
use Yii;


class LoginAction extends Action
{
    public function run()
    {
        $model = new User();
        if ($model->load(Yii::$app->request->post())) {

            $user = User::findByUsername($model->username);

            if ($user && $user->validatePassword($model->password)) {
                Yii::$app->user->login($user, 3600 * 24 * 1); // Авторизация пользователя (с "запомнить меня" на 1 дней)
                Yii::$app->session->setFlash('success', 'Success login');
                return $this->controller->redirect(['/']);
            } else{
             Yii::$app->session->setFlash('error', 'Login error');
            }



            $model->password = '';
            $model->username = '';
        }
        return $this->controller->render('/login', ['model' => $model]);
    }

}