<?php
// Путь: modules/views/profile/index.php

/* @var $this yii\web\View */

$this->title = 'Управление профилями';
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
                        <th>Пользователь</th>
                        <th>Имя</th>
                        <th>Фамилия</th>
                        <th>Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    <!-- Здесь будет список профилей -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>