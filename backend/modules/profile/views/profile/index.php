<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $profile app\models\Profile */

$this->title = 'Профиль пользователя';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="profile-view">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><?= Html::encode($this->title) ?></h1>
        <div>
            <?= Html::a('Редактировать', ['update'], ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Основная информация</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th style="width: 40%">Имя</th>
                            <td><?= Html::encode($profile->first_name) ?></td>
                        </tr>
                        <tr>
                            <th>Фамилия</th>
                            <td><?= Html::encode($profile->last_name) ?></td>
                        </tr>
                        <tr>
                            <th>Отчество</th>
                            <td><?= Html::encode($profile->middle_name ?? '-') ?></td>
                        </tr>
                        <tr>
                            <th>Тип профиля</th>
                            <td>
                                <?php
                                $typeLabels = [
                                    1 => '<span class="badge bg-primary">Клиент</span>',
                                    2 => '<span class="badge bg-success">Сотрудник</span>'
                                ];
                                echo $typeLabels[$profile->type] ?? '-';
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Телефон</th>
                            <td><?= Html::encode($profile->phone ?? '-') ?></td>
                        </tr>
                        <tr>
                            <th>Дата рождения</th>
                            <td><?= $profile->birth_date ? Yii::$app->formatter->asDate($profile->birth_date) : '-' ?></td>
                        </tr>
                        <tr>
                            <th>Адрес</th>
                            <td><?= Html::encode($profile->address ?? '-') ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Документы</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th style="width: 40%">Серия паспорта</th>
                            <td><?= Html::encode($profile->passport_series ?? '-') ?></td>
                        </tr>
                        <tr>
                            <th>Номер паспорта</th>
                            <td><?= Html::encode($profile->passport_number ?? '-') ?></td>
                        </tr>
                        <tr>
                            <th>ИНН</th>
                            <td><?= Html::encode($profile->inn ?? '-') ?></td>
                        </tr>
                        <tr>
                            <th>СНИЛС</th>
                            <td><?= Html::encode($profile->snils ?? '-') ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php if (Yii::$app->user->can('admin')): ?>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Системная информация</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <th style="width: 200px">Дата создания</th>
                                <td><?= Yii::$app->formatter->asDatetime($profile->created_at ?? null) ?></td>
                            </tr>
                            <tr>
                                <th>Дата обновления</th>
                                <td><?= Yii::$app->formatter->asDatetime($profile->updated_at ?? null) ?></td>
                            </tr>
                            <tr>
                                <th>ID пользователя</th>
                                <td><?= Html::encode($profile->user_id ?? '-') ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>