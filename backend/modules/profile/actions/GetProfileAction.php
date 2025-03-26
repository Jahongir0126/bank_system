<?php
namespace backend\modules\profile\actions;

use backend\modules\profile\models\Profile;
use backend\modules\profile\services\ProfileService;
use Yii;
use yii\base\Action;
use yii\web\NotFoundHttpException;

class GetProfileAction extends Action
{
    private $profileService;

    public function __construct($id, $module, ProfileService $profileService, $config = [])
    {
        $this->profileService = $profileService;
        parent::__construct($id, $module, $config);
    }

    public function run()
    {
        $userId = Yii::$app->user->id;

        // Ищем профиль пользователя по user_id
        $profile = Profile::findOne(['user_id' => $userId]);

        if ($profile) {
            return $this->controller->render('index', [
                'profile' => $profile,
            ]);
        } else {
            Yii::$app->session->setFlash('info', 'Profile not found. It is neccessary to create a profile');
            return Yii::$app->response->redirect(['profile/create']);
        }
    }
}