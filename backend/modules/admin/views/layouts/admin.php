<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */

$currentPath = Yii::$app->request->pathInfo;
?>

<?php $this->beginContent('@app/views/layouts/main.php'); ?>

    <div class="admin-layout">
        <div class="container">
            <div class="row">
                <!-- Боковая панель -->
                <div class="col-md-3">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="fas fa-tachometer-alt me-2"></i> Administration Panel
                            </h3>
                        </div>
                        <div class="panel-body p-0">
                            <div class="admin-sidebar">
                                <ul class="nav nav-pills nav-stacked flex-column">
                                    <li class="nav-item">
                                        <!-- Проверяем, что текущий путь точно совпадает с 'admin' или 'admin/index' -->
                                        <a class="nav-link <?= ($currentPath === 'admin' || $currentPath === 'admin/index') ? 'active' : '' ?>" href="<?= Url::to(['/admin']) ?>">
                                            <i class="fas fa-chart-line"></i> Dashboard
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link <?= strpos($currentPath, 'admin/users') !== false ? 'active' : '' ?>" href="<?= Url::to(['/admin/users']) ?>">
                                            <i class="fas fa-users"></i> Users
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link <?= strpos($currentPath, 'admin/profiles') !== false ? 'active' : '' ?>" href="<?= Url::to(['/admin/profiles']) ?>">
                                            <i class="fas fa-id-card"></i> Profiles
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?= Url::to(['/site/index']) ?>">
                                            <i class="fas fa-arrow-left"></i> Back to Site
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Информация о текущем пользователе -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fas fa-user-circle me-2"></i> Your Account</h3>
                        </div>
                        <div class="panel-body">
                            <?php if (!Yii::$app->user->isGuest): ?>
                                <div class="text-center mb-3">
                                    <i class="fas fa-user-shield fa-3x text-muted"></i>
                                    <h5 class="mt-2 mb-1"><?= Yii::$app->user->identity->username ?></h5>
                                    <small class="text-muted">Administrator</small>
                                </div>
                                <div class="d-grid gap-2 mt-3">
                                    <?= Html::a('<i class="fas fa-sign-out-alt me-2"></i> Logout', ['/site/logout'], [
                                        'class' => 'btn btn-outline-danger btn-sm',
                                        'data' => ['method' => 'post']
                                    ]) ?>
                                </div>
                            <?php else: ?>
                                <p class="text-center">Вы не авторизованы</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Основное содержимое -->
                <div class="col-md-9">
                    <?= $content ?>
                </div>
            </div>
        </div>
    </div>

<?php $this->endContent(); ?>