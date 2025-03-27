<?php

namespace backend\modules\admin\actions;

use backend\modules\admin\services\AdminService;
use Yii;
use yii\base\Action;

class UpdateProfileAction extends  Action
{
    private $adminService;

    public function __construct($id, $module, AdminService $adminService, $config = [])
    {
        $this->adminService = $adminService;
        parent::__construct($id, $module, $config);
    }

    public function run($id){

        $profile =$this->adminService->getProfileById($id);

        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();

            $result = $this->adminService->updateProfile($id, $data);
            if (isset($result['errors'])) {
                return $this->controller->redirect('profiles');


            return ['success' => false, 'errors' => $result['errors']];
        }

        return $this->controller->render('update-profile',['profile' => $profile,]);
    }
}