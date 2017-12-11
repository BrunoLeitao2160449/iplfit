<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="create-form">

    <?php $form = ActiveForm::begin(['id' => 'create-food-form']); ?>


    <?= $form->field($data, 'nome')->textInput(['autofocus' => true])->label('Nome') ?>

    <?= $form->field($data, 'calorias')->textInput(['type' => 'decimal'])->label('Calorias (Kcal)') ?>

    <?= $form->field($data, 'lipidos')->textInput(['type' => 'decimal'])->label('Lipídos (g)') ?>

    <?= $form->field($data, 'carboidratos')->textInput(['type' => 'decimal'])->label('Carboidratos (g)') ?>

    <?= $form->field($data, 'proteina')->textInput(['type' => 'decimal'])->label('Proteína (g)') ?>

    <div class="form-group">
        <?= Html::submitButton('Create', ['class' => 'btn btn-success', 'name' => 'create-button']) ?>

    </div>
    <?php ActiveForm::end(); ?>

</div>