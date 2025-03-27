<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $profile app\models\Profile */

$this->title = 'User Profile';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="profile-view">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><?= Html::encode($this->title) ?></h1>
        <div>
            <?= Html::a('Update', ['/admin/update-profile', 'id' => $profile->id], ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Main Info</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th style="width: 40%">First Name</th>
                            <td><?= Html::encode($profile->first_name) ?></td>
                        </tr>
                        <tr>
                            <th>Last Name</th>
                            <td><?= Html::encode($profile->last_name) ?></td>
                        </tr>
                        <tr>
                            <th>Middle Name</th>
                            <td><?= Html::encode($profile->middle_name ?? '-') ?></td>
                        </tr>
                        <tr>
                            <th>Profile Type</th>
                            <td>
                                <?php
                                $typeLabels = [
                                    1 => '<span>Client</span>',
                                    2 => '<span>Employee</span>',
                                    3 => '<span>Vip Client</span>',
                                    4 => '<span >Manager</span>',
                                ];
                                echo $typeLabels[$profile->type] ?? '-';
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td><?= Html::encode($profile->phone ?? '-') ?></td>
                        </tr>
                        <tr>
                            <th>Birth date</th>
                            <td><?= $profile->birth_date ? Yii::$app->formatter->asDate($profile->birth_date) : '-' ?></td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td><?= Html::encode($profile->address ?? '-') ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Documents</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th style="width: 40%">Passport series</th>
                            <td><?= Html::encode($profile->passport_series ?? '-') ?></td>
                        </tr>
                        <tr>
                            <th>Passport number</th>
                            <td><?= Html::encode($profile->passport_number ?? '-') ?></td>
                        </tr>
                        <tr>
                            <th>INN</th>
                            <td><?= Html::encode($profile->inn ?? '-') ?></td>
                        </tr>
                        <tr>
                            <th>SNILS</th>
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
                        <h3 class="card-title">System info</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <th style="width: 200px">Created date</th>
                                <td><?= Yii::$app->formatter->asDatetime($profile->created_at ?? null) ?></td>
                            </tr>
                            <tr>
                                <th>Updated date</th>
                                <td><?= Yii::$app->formatter->asDatetime($profile->updated_at ?? null) ?></td>
                            </tr>
                            <tr>
                                <th>User Id</th>
                                <td><?= Html::encode($profile->user_id ?? '-') ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>