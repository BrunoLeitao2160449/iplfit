<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

cakebake\bootstrap\select\BootstrapSelectAsset::register($this, [
    'selector' => '.selectpicker', //The jQuery selector (all select forms by default)
    'menuArrow' => true, //You can also show the tick icon on single select
    'tickIcon' => false, //The bootstrap menu arrow can be added
    'selectpickerOptions' => [ //available bootstrap-select data options @see http://silviomoreto.github.io/bootstrap-select/3/#options
        'size' => 3, //example option @see http://silviomoreto.github.io/bootstrap-select/3/#options
        'width' => '50%', //example option @see http://silviomoreto.github.io/bootstrap-select/3/#options
    ],
]);

$this->title="Food Manager";
?>

<div class="container">

    <?php

    Modal::begin([
        'header' => '<h4>Aviso! <br> <br> Tem a certeza que pertende remover este alimento? </h4>',
        'id' => 'modal',
        'size' => 'modal-s',
    ]);

    echo "<div id='modalContent'></div>";

    Modal::end();

    ?>

    <?php

    Modal::begin([
        'header' => '<h4>EditForm Food</h4>',
        'id' => 'modal_update_food',
        'size' => 'modal-lg',
    ]);

    echo "<div id='modalContent'></div>";

    Modal::end();

    ?>

    <?php

    Modal::begin([
        'header' => '<h4>Adicionar Alimento</h4> <br> Alimento adiconado por 100g',
        'id' => 'modal_create_food',
        'size' => 'modal-lg',
    ]);

    echo "<div id='modalContent'></div>";

    Modal::end();

    ?>

    <div class="row">
        <div class="col-xs-12">
            <div class="container text-center">
                <h2 class="page-header">Controlo de Alimentos</h2>
                <p class="lead">Procure os alimentos pela nossa forma simples e intuitiva!</p>
            </div>
        </div>
    </div>

    <div class="container text-center" style="width: 60%; margin-top: 2%">

        <div class="input-group input-group-lg">

            <span class="input-group-btn">

            </span>

            <input type="text" maxlength="200" class="form-control" id="pesquisa_text_food" placeholder="Search">

            <div class="pesquisa-control-food" data-info="<?= Url::toRoute(['food/searchfood']); ?>"></div>

            <select id="pesquisa_food_como" class="selectpicker" data-style="btn-primary">
                <option value="nome">Nome (Kcal) &nbsp</option>
                <option value="calorias">Calorias (g) &nbsp</option>
                <option value="lipidos">Lipídos (g) &nbsp</option>
                <option value="carboidratos">Carboidratos (g) &nbsp</option>
                <option value="proteina">Proteína (g) &nbsp</option>
            </select>

        </div>

    </div>

        <div class="col-xs-3">
            <h2>
                <?= Html::button('Adicionar Alimento', ['value' => Url::to(['food/create']), 'class'=>'btn btn-success', 'id' => 'modalBtnAddFood']) ?>
            </h2>
        </div>

    <table class="table" id="table_food_search" style="margin-top: 8%">
        <thead>

        <tr>
            <th >*Por 100g</th>
            <th ></th>
            <th ></th>
            <th ></th>
            <th ></th>
            <th ></th>
        </tr>
        <tr>

            <th style="text-align: center">Nome</th>
            <th style="text-align: center">*Calorias (Kcal)</th>
            <th style="text-align: center">*Lipídos (g)</th>
            <th style="text-align: center">*Carboidratos (g)</th>
            <th style="text-align: center">*Proteína (g)</th>
            <th class="col-sm-2" style="text-align: center">Actions</th>
        </tr>
        </thead>
        <div id="pesquisa_button_edit" data-info="<?= Url::to(['food/update?id=']) ?>" />
        <div id="pesquisa_button_delete" data-info="<?= Url::to(['food/delete?response='. null . '&id=']) ?>" />
        <tbody id="table_search_food_body">
        <?php foreach ( $data as $key => $record) {?>
            <tr id="row_search_food" >
                <td id="row_nome">
                    <?= $record->nome ?>
                </td>
                <td id="row_calorias" style="text-align: center">
                    <?= $record->calorias ?>
                </td>
                <td id="row_lipidos" style="text-align: center">
                    <?= $record->lipidos ?>
                </td>
                <td id="row_carboidratos" style="text-align: center">
                    <?= $record->carboidratos ?>
                </td>
                <td id="row_proteina" style="text-align: center">
                    <?= $record->proteina ?>
                </td>
                <td style="text-align: center">
                    <?= Html::button('Editar', ['value' => Url::to(['food/update?id=' . $record->id]), 'class'=>'btn btn-primary btn-xs', 'id' => 'modalBtnEditFood']) ?>

                    <?= Html::button('Remover', ['value' => Url::to(['food/delete?id='.$record->id.'&response='.null]), 'class'=>'btn btn-danger btn-xs', 'id' => 'modalBtn']) ?>
                </td>
            </tr>
        <?php }?>
        </tbody>
    </table>
</div>
