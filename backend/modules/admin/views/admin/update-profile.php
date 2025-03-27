<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $profile backend\modules\profile\models\Profile */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Profile Update';
$this->params['breadcrumbs'][] = ['label' => 'Profiles', 'url' => ['profiles']];
$this->params['breadcrumbs'][] = ['label' => $profile->id, 'url' => ['/admin/profile', 'id' => $profile->id]];
$this->params['breadcrumbs'][] = 'Updating';


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
                    <h4>Main Info</h4>
                </div>
                <div class="card-body">
                    <?= $form->field($profile, 'first_name')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($profile, 'last_name')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($profile, 'middle_name')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($profile, 'type',['options' => ['class' => 'form-group field-spacing']])->dropDownList([
                        1 => 'Клиент',
                        2 => 'Employee',
                        3 => 'Vip Client',
                        4 => 'Manager',
                    ], ['prompt' => 'Select profile type']) ?>

                    <?= $form->field($profile, 'phone')->textInput(['maxlength' => true, 'placeholder' => '+998 (99) 999-99-99']) ?>
                    <?= $form->field($profile, 'address')->textarea(['rows' => 3, 'maxlength' => 1000]) ?>
                    <?= $form->field($profile, 'birth_date')->widget(DatePicker::class, [
                        'language' => 'ru',
                        'dateFormat' => 'yyyy-MM-dd',
                        'options' => [
                            'class' => 'form-control',
                            'placeholder' => 'Select birth date',
                        ],

                    ]) ?>

                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Documents</h4>
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