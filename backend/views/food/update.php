<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="update-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($data, 'title')->textInput(['autofocus' => true]) ?>

    <?= $form->field($data, 'content')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Edit', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>