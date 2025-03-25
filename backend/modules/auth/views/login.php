<?php
use \yii\helpers\Html;
use \yii\widgets\ActiveForm;
$this->title = 'Log in';
?>


<h1><?= Html::encode($this->title) ?></h1>

<div class="site-login">
    <h5>Fill in the fields below to Login:</h5>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
    ]); ?>

    <?= $form->field($model, 'username',['options'=>['class'=>'form-group mt-3']])->textInput()->label('Username') ?>
    <?= $form->field($model, 'password',['options'=>['class'=>'form-group mt-3']])->passwordInput()->label('Password') ?>

    <div class="form-group">
        <?= Html::submitButton('Login', ['class' => 'btn btn-primary mt-4', 'name' => 'login-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
