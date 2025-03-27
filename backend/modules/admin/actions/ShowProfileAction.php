<?php

namespace backend\modules\admin\actions;

use backend\modules\admin\services\AdminService;
use backend\modules\profile\models\Profile;
use backend\modules\profile\services\ProfileService;
use yii\base\Action;

class ShowProfileAction extends Action
{

    private $adminService;

    public function __construct($id, $module, AdminService $adminService, $config = [])
    {
       $this->adminService = $adminService;
       parent::__construct($id, $module, $config);
    }

    public function run($id)
    {
        $profile = $this->adminService->getProfileById($id);
        return $this->controller->render('show-profile', ['profile' => $profile]);


    }
}