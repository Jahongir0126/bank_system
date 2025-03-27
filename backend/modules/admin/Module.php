<?php

namespace backend\modules\admin;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'backend\modules\admin\controllers';

    public $defaultRoute = 'admin';
    public function init()
    {
        parent::init();

        $this->setAliases([
            '@admin' => __DIR__,
        ]);
    }

}