<?php

namespace backend\modules\client;

use yii\base\Module as BaseModule;

class Module extends BaseModule
{
    public $controllerNamespace = 'backend\modules\client\controllers';
    public $defaultRoute = 'client';

    public function init()
    {
        parent::init();
        
        // Инициализация модуля
        $this->setAliases([
            '@client' => __DIR__,
        ]);
    }
} 