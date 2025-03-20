<?php

namespace backend\modules\auth;

use yii\base\Module as BaseModule;

class Module extends BaseModule
{
    public $controllerNamespace = 'backend\modules\auth\controllers';
    public $defaultRoute = 'auth';

    public function init()
    {
        parent::init();
        
        // Инициализация модуля
        $this->setAliases([
            '@auth' => __DIR__,
        ]);
    }
} 