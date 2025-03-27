<?php

namespace backend\modules\admin\actions;

use backend\modules\admin\services\AdminService;
use yii\base\Action;

class GetUsersAction extends Action
{

    private $adminService;

    public function __construct($id, $module, AdminService $adminService, $config = [])
    {
        $this->adminService = $adminService;
        parent::__construct($id, $module, $config);
    }

   public function run(){
       $users = $this->adminService->getAllUsers();
       return $this->controller->render('user', ['users' => $users]);
   }

}