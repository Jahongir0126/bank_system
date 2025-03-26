<?php

namespace backend\modules\profile\actions;

use backend\modules\profile\models\Profile;
use yii\base\Action;

class UpdateProfileAction extends Action
{
    public function run()
    {
        $profile=Profile::findOne(['user_id'=>\Yii::$app->user->id]);

        if(!$profile){
            \Yii::$app->session->setFlash('info', 'Profile not found');
            return $this->controller->redirect(['/profile/create']);
        }

        if($profile->load(\Yii::$app->request->post()) ){

            if ($profile->save()) {
                \Yii::$app->session->setFlash('success', 'Profile updated successfully');
                return $this->controller->redirect(['/profile']);
            }else{

                $errors = $profile->getErrorSummary(true);
                $errorMsg = implode('<br>', $errors);
                \Yii::$app->session->setFlash('error', 'Profile update Error: <br>' . $errorMsg);

            }
        }

        return $this->controller->render('update', ['profile' => $profile]);
    }

}