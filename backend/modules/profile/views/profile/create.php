<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

$this->title = 'Создание профиля';

$this->registerCss('
    .field-spacing {
        margin-top: 10px;
    }
    .field-spacing:first-child {
        margin-top: 0;
    }
');



?>
<h1><?= Html::encode($this->title) ?></h1>
<div class="profile-create">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>Основная информация</h4></div>
                <div class="panel-body">
                    <?= $form->field($profile, 'first_name',['options' => ['class' => 'form-group field-spacing']]
                    )->textInput(['maxlength' => true]) ?>
                    <?= $form->field($profile, 'last_name',['options' => ['class' => 'form-group field-spacing']])->textInput(['maxlength' => true]) ?>
                    <?= $form->field($profile, 'middle_name',['options' => ['class' => 'form-group field-spacing']])->textInput(['maxlength' => true]) ?>
                    <?= $form->field($profile, 'type',['options' => ['class' => 'form-group field-spacing']])->dropDownList([
                        1 => 'Client',
                        2 => 'Employee',
                        3 => 'Vip Client',
                        4 => 'Manager',
                    ], ['prompt' => 'Select profile type']) ?>


                    <?= $form->field($profile, 'phone',['options' => ['class' => 'form-group field-spacing']])->textInput(['maxlength' => true, 'placeholder' => '+998 (99) 999-99-99']) ?>
                    <?= $form->field($profile, 'address',['options' => ['class' => 'form-group field-spacing']])->textarea(['rows' => 3, 'maxlength' => 1000]) ?>
                    <?= $form->field($profile, 'birth_date',['options' => ['class' => 'form-group field-spacing']])->widget(DatePicker::class, [
                        'language' => 'ru',
                        'dateFormat' => 'yyyy-MM-dd',
                        'options' => ['class' => 'form-control', 'placeholder' => 'Выберите дату рождения'],
                    ]) ?>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>Документы</h4></div>
                <div class="panel-body">
                    <?= $form->field($profile, 'passport_series')->textInput(['maxlength' => 50]) ?>
                    <?= $form->field($profile, 'passport_number')->textInput(['maxlength' => 50]) ?>
                    <?= $form->field($profile, 'inn')->textInput(['maxlength' => 12]) ?>
                    <?= $form->field($profile, 'snils')->textInput(['maxlength' => 11]) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success mt-4']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>