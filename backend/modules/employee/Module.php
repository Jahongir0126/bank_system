<?php

namespace backend\modules\employee;

use yii\base\Module as BaseModule;

class Module extends BaseModule
{
    public $controllerNamespace = 'backend\modules\employee\controllers';
    public $defaultRoute = 'employee';

    public function init()
    {
        parent::init();
        
        // Инициализация модуля
        $this->setAliases([
            '@employee' => __DIR__,
        ]);
    }
} 