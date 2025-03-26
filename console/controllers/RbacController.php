<?php

namespace console\controllers;


use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = \Yii::$app->authManager;
        $auth->removeAll();

        $admin = $auth->createRole('admin');
        $employee = $auth->createRole('employee');
        $user = $auth->createRole('user');


        $auth->add($admin);
        $auth->add($employee);
        $auth->add($user);

        $auth->addChild($admin, $employee);
        $auth->addChild($employee, $user);

        echo "Roles created\n";
    }
    public function actionAssignRole($userId, $roleName){
        $auth = \Yii::$app->authManager;
        $role = $auth->getRole($roleName);
        if(!$role){
            echo "Role '{$roleName}' not found.\n";
            return;
        }
        $auth->assign($role, $userId);
        echo "Role '{$roleName}' assigned to user ID {$userId}.\n";
    }

}