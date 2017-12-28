<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

<div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
    <div class="panel panel-info" style="border-color: #585858">
        <div class="panel-heading" style="background-color: #585858">
            <div class="panel-title" style="color: white">Sign In</div>
        </div>

        <div style="padding-top:30px" class="panel-body" >


            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'nome')->textInput()?>

            <?= $form->field($model, 'email')->textInput() ?>

            <?= $form->field($model,'data_nasc')->textInput(['type' => 'date', 'format' => 'php:Y-m-d']) ?>

            <?= $form->field($model, 'altura')->textInput(['type' => 'decimal']) ?>

            <?= $form->field($model, 'peso')->textInput(['type' => 'decimal']) ?>

            <?= $form->field($model, 'meta_peso')->textInput(['type' => 'decimal']) ?>

            <?= $form->field($model, 'id_activity')->dropDownList(['1' => 'Sedentário', '2' => 'Actividade ligeira', '3' => 'Actividade moderada',
                '4' => 'Actividade intensa', '5' => 'Actividade muito intensa'],['prompt'=>'Select Option']); ?>

            <?= $form->field($model, 'obs')->textInput() ?>

            <div class="form-group">
                <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
</div>
