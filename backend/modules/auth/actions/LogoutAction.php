<?php


namespace backend\modules\auth\actions;

use Yii;
use yii\base\Action;

class LogoutAction extends Action
{
    public function run()
    {
        Yii::$app->user->logout();
        return $this->controller->goHome(); // Перенаправляем на главную страницу после выхода
    }

}