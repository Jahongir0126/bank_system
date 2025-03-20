<?php

use yii\db\Migration;
use yii\rbac\DbManager;

class m250318_211937_init_rbac extends Migration
{
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        // Проверяем, есть ли роли перед добавлением
        if (!$auth->getRole('admin')) {
            $admin = $auth->createRole('admin');
            $auth->add($admin);
        }
        if (!$auth->getRole('employee')) {
            $employee = $auth->createRole('employee');
            $auth->add($employee);
        }
        if (!$auth->getRole('client')) {
            $client = $auth->createRole('client');
            $auth->add($client);
        }

        // Проверяем, есть ли разрешения перед добавлением
        if (!$auth->getPermission('manageUsers')) {
            $manageUsers = $auth->createPermission('manageUsers');
            $manageUsers->description = 'Управление пользователями';
            $auth->add($manageUsers);
            $auth->addChild($admin, $manageUsers);
        }

        if (!$auth->getPermission('viewProfile')) {
            $viewProfile = $auth->createPermission('viewProfile');
            $viewProfile->description = 'Просмотр профиля';
            $auth->add($viewProfile);
            $auth->addChild($employee, $viewProfile);
            $auth->addChild($client, $viewProfile);
        }
    }

    public function safeDown()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll(); // Удаляем все роли и разрешения
    }
}
