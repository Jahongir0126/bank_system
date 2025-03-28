<?php

namespace backend\modules\auth\actions;

use backend\modules\user\models\User;
use yii\base\Action;
use Yii;

class SignUpAction extends Action
{
    public function run()
    {
        $model = new User();
        if ($model->load(Yii::$app->request->post())) {

            $model->auth_key = Yii::$app->security->generateRandomString();
            $model->password_hash = Yii::$app->security->generatePasswordHash($model->password);

            if ($model->validate() && $model->save()) {
                Yii::$app->session->setFlash('success', 'Success registrated');
                return $this->controller->redirect(['auth/login']);
                $model->password = '';
                $model->username='';
                $model->email='';

            } else {
                Yii::$app->session->setFlash('error', 'Register error');
            }



        }


        return $this->controller->render('/signup', [
            'model' => $model,
        ]);
    }

}