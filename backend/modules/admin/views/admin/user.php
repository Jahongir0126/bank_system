<?php
// Путь: modules/views/user/index.php

/* @var $this yii\web\View */
/* @var backend\modules\user\models\User $users */

use yii\helpers\Html;

$this->title = 'User Management';
?>

<div class="admin-users">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?= $this->title ?></h3>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user->id ?></td>
                        <td><?= $user->username ?></td>
                        <td><?= $user->email ?></td>
                        <td><?= $user->status==10 ? 'Active ' : ($user->status == 9 ? 'Inactive' : 'Deleted') ?></td>
                        <td>
                            <?= Html::a(
                                'Delete',
                                ['/admin/delete-user', 'id' => $user->id],
                                ['class' => 'btn btn-danger']) ?>
                        </td>


                        <?php endforeach; ?>
                    <!-- Здесь будет список пользователей -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
