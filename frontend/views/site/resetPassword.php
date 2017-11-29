<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>

<div class="site-reset-password">
    <h1><?= Html::encode($this->title) ?></h1>

    <div style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">

        <div class="panel panel-info" style="border-color: #585858">
            <div class="panel-heading" style="background-color: #585858">
                <div class="panel-title" style="color: white">Request password reset</div>
            </div>

            <div style="padding-top:30px" class="panel-body" >
                <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

                <p>Please choose your new password:</p>

                <?= $form->field($model, 'password')->passwordInput(['autofocus' => true]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>


