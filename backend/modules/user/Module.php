<?php

namespace backend\modules\user;

use yii\base\Module as BaseModule;

class Module extends BaseModule
{
    public $controllerNamespace = 'backend\modules\user\controllers';
    public $defaultRoute = 'user';

    public function init()
    {
        parent::init();
        
        // Инициализация модуля
        $this->setAliases([
            '@user' => __DIR__,
        ]);
    }
} 