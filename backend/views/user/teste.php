<?php
/**
 * Created by PhpStorm.
 * User: b_ml_
 * Date: 30/11/2017
 * Time: 11:56
 */
use yii\helpers\Html;
use yii\widgets\DetailView;

?>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'username',
        'email',
        [
            'label' => 'Nome',
            'value' => $model->complemento->nome,
        ],
    ],
]) ?>
