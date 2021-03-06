<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">

        <div class="panel panel-info" style="border-color: #585858">
            <div class="panel-heading" style="background-color: #585858">
                <div class="panel-title" style="color: white">Request password reset</div>
            </div>

            <div style="padding-top:30px" class="panel-body" >
                <p>Please fill out your email. A link to reset password will be sent there.</p>
                <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

                <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Send', ['class' => 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>
