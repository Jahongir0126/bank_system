<?php

namespace backend\modules\profile\actions;

use backend\modules\profile\models\Profile;
use yii\base\Action;

class CreateProfileAction extends Action
{
    public function run()
    {
        // Проверяем, существует ли уже профиль для текущего пользователя
        $existingProfile = Profile::findOne(['user_id' => \Yii::$app->user->id]);

        if ($existingProfile) {
            // Если профиль уже существует, перенаправляем на просмотр существующего
            \Yii::$app->session->setFlash('info', 'Profile already exists.');
            return $this->controller->redirect(['/profile']);
        }

        $profile = new Profile();
        $profile->user_id = \Yii::$app->user->id;

        if ($profile->load(\Yii::$app->request->post()) && $profile->save()) {
            \Yii::$app->session->setFlash("success", "Profile created successfully.");
            return $this->controller->redirect(['/profile']);
        }

        return $this->controller->render('create', ['profile' => $profile]);
    }
}