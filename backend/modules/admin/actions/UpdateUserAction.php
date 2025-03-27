<?php

namespace backend\modules\admin\actions;

use backend\modules\admin\services\AdminService;
use yii\base\Action;
use Yii;

class UpdateUserAction extends Action
{
    private $adminService;

    public function __construct($id, $module, AdminService $adminService, $config = [])
    {
        $this->adminService = $adminService;
        parent::__construct($id, $module, $config);
    }

    public function run($id){
        var_dump($id);
        exit;
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $model =$this->adminService->findUserById($id);

        if(Yii::$app->request->isPost){
            $data = Yii::$app->request->post();
            if($this->adminService->updateUser($id,$data)){
                return ['success' => true];
            }
            return ['success' => false,'error'=>$model->errors];

        }
        return $this->controller->render('update-user',['model' => $model,]);
    }

}