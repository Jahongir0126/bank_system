<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $profile backend\modules\profile\models\Profile */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Редактирование профиля';
$this->params['breadcrumbs'][] = ['label' => 'Профили', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $profile->id, 'url' => ['view', 'id' => $profile->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>

<div class="profile-update">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin([
        'fieldConfig' => [
            'options' => ['class' => 'form-group mb-3'],
        ],
    ]); ?>

    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Основная информация</h4>
                </div>
                <div class="card-body">
                    <?= $form->field($profile, 'first_name')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($profile, 'last_name')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($profile, 'middle_name')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($profile, 'phone')->textInput(['maxlength' => true, 'placeholder' => '+998 (99) 999-99-99']) ?>
                    <?= $form->field($profile, 'address')->textarea(['rows' => 3, 'maxlength' => 1000]) ?>

                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Документы</h4>
                </div>
                <div class="card-body">
                    <?= $form->field($profile, 'passport_series')->textInput(['maxlength' => 50]) ?>
                    <?= $form->field($profile, 'passport_number')->textInput(['maxlength' => 50]) ?>
                    <?= $form->field($profile, 'inn')->textInput(['maxlength' => 12]) ?>
                    <?= $form->field($profile, 'snils')->textInput(['maxlength' => 11]) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить изменения', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Отмена', ['/profile', 'id' => $profile->id], ['class' => 'btn btn-secondary ms-2']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>