<?php
use yii\helpers\Html;

$this->title = 'Admin Dashboard';
?>

<div class="admin-index">
    <!-- Заголовок -->
    <div class="panel">
        <div class="panel-heading d-flex justify-content-between align-items-center">
            <h3 class="panel-title"><i class="fas fa-tachometer-alt me-2"></i> <?= Html::encode($this->title) ?></h3>
            <span class="badge bg-primary"><?= date('d M Y') ?></span>
        </div>
        <div class="panel-body">
            <p class="welcome-message">Welcome to the administration panel. Here you can manage users, profiles and other system components.</p>

            <!-- Статистические карточки -->


            <!-- Таблицы с краткой информацией -->
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-user-clock me-2"></i> Recent Users</span>
                            <?= Html::a('All Users <i class="fas fa-arrow-right"></i>', ['/admin/users'], ['class' => 'btn btn-sm btn-outline-primary']) ?>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-sm table-hover mb-0">
                                    <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>user1</td>
                                        <td>user1@example.com</td>
                                        <td><span class="badge bg-success">Active</span></td>
                                    </tr>
                                    <tr>
                                        <td>user2</td>
                                        <td>user2@example.com</td>
                                        <td><span class="badge bg-danger">Blocked</span></td>
                                    </tr>
                                    <tr>
                                        <td>user3</td>
                                        <td>user3@example.com</td>
                                        <td><span class="badge bg-success">Active</span></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-id-badge me-2"></i> Recent Profiles</span>
                            <?= Html::a('All Profiles <i class="fas fa-arrow-right"></i>', ['/admin/profiles'], ['class' => 'btn btn-sm btn-outline-primary']) ?>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-sm table-hover mb-0">
                                    <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Name</th>
                                        <th>Last Update</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>user1</td>
                                        <td>John Smith</td>
                                        <td><?= date('Y-m-d', strtotime('-2 days')) ?></td>
                                    </tr>
                                    <tr>
                                        <td>user2</td>
                                        <td>Anna Johnson</td>
                                        <td><?= date('Y-m-d', strtotime('-1 week')) ?></td>
                                    </tr>
                                    <tr>
                                        <td>user3</td>
                                        <td>Robert Brown</td>
                                        <td><?= date('Y-m-d', strtotime('-3 days')) ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Системная информация -->
            <div class="panel mt-4">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fas fa-server me-2"></i> System Information</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>PHP Version:</strong> <?= PHP_VERSION ?></p>
                            <p><strong>Yii Version:</strong> <?= Yii::getVersion() ?></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Server Time:</strong> <?= date('Y-m-d H:i:s') ?></p>
                            <p><strong>Memory Usage:</strong> <?= round(memory_get_usage() / 1024 / 1024, 2) ?> MB</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>