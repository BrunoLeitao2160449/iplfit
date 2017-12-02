<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use common\models\Complemento;
?>

<div class="user-view">
    <?php

    if(empty($model->complemento->obs)){ ?>

        <?=
            DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'username',
                    [
                        'label' => 'Nome',
                        'value' => $model->complemento->nome,
                    ],
                    'email:email',
                    [
                        'label' => 'Data de Nascimento',
                        'value' => $model->complemento->data_nasc,
                    ],
                    [
                        'label' => 'Height',
                        'value' => $model->complemento->altura,
                    ],
                    [
                        'label' => 'Weight',
                        'value' => $model->complemento->peso,
                    ],
                    [
                        'label' => 'Goal Weight',
                        'value' => $model->complemento->meta_peso,
                    ],
                ],
            ]);
        ?>

    <?php
    } else {?>

        <?=
            DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'username',
                    [
                        'label' => 'Nome',
                        'value' => $model->complemento->nome,
                    ],
                    'email:email',
                    [
                        'label' => 'Data de Nascimento',
                        'value' => $model->complemento->data_nasc,
                    ],
                    [
                        'label' => 'Height',
                        'value' => $model->complemento->altura,
                    ],
                    [
                        'label' => 'Weight',
                        'value' => $model->complemento->peso,
                    ],
                    [
                        'label' => 'Goal Weight',
                        'value' => $model->complemento->meta_peso,
                    ],

                    [
                        'label' => 'Observations',
                        'value' => $model->complemento->obs,
                    ],
                ],
            ]);
        ?>
    <?php
    }
    ?>



</div>
