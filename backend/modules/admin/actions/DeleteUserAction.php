<?php

namespace backend\modules\admin\actions;

use backend\modules\admin\services\AdminService;
use yii\base\Action;
use yii\web\Response;

class DeleteUserAction extends Action
{
    private $adminService;

    public function __construct($id, $module, AdminService $adminService, $config = [])
    {
        $this->adminService = $adminService;
        parent::__construct($id, $module, $config);
    }

    public function run($id)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;

        try {
            $this->adminService->deleteUserWithProfile($id);
            return [
                'success' => true,
                'message' => 'Пользователь успешно удален'
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }

}