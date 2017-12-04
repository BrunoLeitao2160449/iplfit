<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Update User: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="user-form">

        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'nome')->textInput()?>

        <?= $form->field($model, 'email')->textInput() ?>

        <?= $form->field($model,'data_nasc')->textInput(['type' => 'date', 'format' => 'php:Y-m-d']) ?>

        <?= $form->field($model, 'altura')->textInput(['type' => 'decimal']) ?>

        <?= $form->field($model, 'peso')->textInput(['type' => 'decimal']) ?>

        <?= $form->field($model, 'meta_peso')->textInput(['type' => 'decimal']) ?>

        <div class="form-group">
            <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
        </div>
        <?php ActiveForm::end(); ?>

    </div>

</div>