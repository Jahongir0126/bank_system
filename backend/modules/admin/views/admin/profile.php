<?php
// Путь: modules/views/profile/index.php

/* @var $this yii\web\View */
use yii\helpers\Html;
$profileTypes = [
    1 => 'Client',
    2 => 'Employee',
    3 => 'VIP Client',
    4 => 'Manager'
];


$this->title = 'Profile Management';
?>

<div class="admin-profiles">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?= $this->title ?></h3>
        </div>
        <div class="panel-body">
            <!-- Содержимое страницы управления профилями -->
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>User Id</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Type</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($profiles as $profile): ?>
                    <tr>
                        <td><?= $profile->id ?></td>
                        <td><?= $profile->user_id?></td>
                        <td><?= $profile->first_name  ?></td>
                        <td><?= $profile->last_name  ?></td>
                        <td> <?php  $typeValue = $profile->type;
                            echo '<span>' .
                                (isset($profileTypes[$typeValue]) ? $profileTypes[$typeValue] : 'Неизвестно') .
                                '</span>';
                            ?>
                        </td>
                        <td>
                            <?= Html::a(
                                'Show',
                                ['/admin/profile', 'id' => $profile->id],
                                ['class' => 'btn btn-primary'])  ?>
                            <?= Html::a(
                                'Update',
                                ['/admin/update-profile', 'id' => $profile->id],
                                ['class' => 'btn btn-warning'])  ?>
                            <?= Html::a(
                                'Delete',
                                ['/admin/delete-profile', 'id' => $profile->id],
                                ['class' => 'btn btn-danger'])  ?>
                        </td>
                    </tr>

                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>