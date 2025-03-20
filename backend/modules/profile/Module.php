<?php

namespace backend\modules\profile;

use yii\base\Module as BaseModule;

class Module extends BaseModule
{
    public $controllerNamespace = 'backend\modules\profile\controllers';
    public $defaultRoute = 'profile';

    public function init()
    {
        parent::init();
        
        // Инициализация модуля
        $this->setAliases([
            '@profile' => __DIR__,
        ]);
    }
} 