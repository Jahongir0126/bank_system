<?php
use \yii\helpers\Html;
use \yii\widgets\ActiveForm;
$this->title = 'Registration';
?>



<div class="site-signup">
    <h1><?= \yii\helpers\Html::encode($this->title) ?></h1>

    <p>Fill in the fields below to register:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = \yii\widgets\ActiveForm::begin(); ?>

            <?= $form->field($model, 'username',['options'=>['class'=>'form-group mt-3']])->textInput()->label('Username') ?>

            <?= $form->field($model, 'email',['options'=>['class'=>'form-group mt-3']])->textInput()->label('Email') ?>

            <?= $form->field($model, 'password',['options'=>['class'=>'form-group mt-3']])->passwordInput()->label('Password') ?>

            <div class="form-group">
                <?= Html::submitButton('Register', ['class' => 'btn btn-primary mt-5']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

