<?php

namespace backend\modules\admin\actions;

use backend\modules\admin\services\AdminService;
use yii\base\Action;

class GetProfilesAction extends Action
{
    private $adminService;

    public function __construct($id, $module, AdminService $adminService, $config = [])
    {
        $this->adminService = $adminService;
        parent::__construct($id, $module, $config);
    }

    public function run(){
        $profiles = $this->adminService->getProfiles();
        return $this->controller->render('profile', ['profiles' => $profiles]);

    }
}