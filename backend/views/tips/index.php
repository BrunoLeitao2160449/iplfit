<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

cakebake\bootstrap\select\BootstrapSelectAsset::register($this, [
    'selector' => '.selectpicker',
    'menuArrow' => true,
    'tickIcon' => false,
    'selectpickerOptions' => [
        'size' => 3,
        'width' => '50%',
    ],
]);

$this->title=$title;
?>

<div class="container">

<?php

    Modal::begin([
        'header' => '<h4>Warning! <br> <br> Are you sure you want to delete this Tip? </h4>',
        'id' => 'modal',
        'size' => 'modal-s',
    ]);

    echo "<div id='modalContent'></div>";

    Modal::end();

?>

<?php

Modal::begin([
    'header' => '<h4>EditForm Tip</h4>',
    'id' => 'modal_edit_tip',
    'size' => 'modal-lg',
]);

echo "<div id='modalContent'></div>";

Modal::end();

?>

<?php

Modal::begin([
    'header' => '<h4>Create Tip</h4>',
    'id' => 'modal_create_tip',
    'size' => 'modal-lg',
]);

echo "<div id='modalContent'></div>";

Modal::end();

?>

<div class="row">
    <div class="col-xs-12">
        <div class="container text-center">
            <h2 class="page-header">
                <?= $title ?></h2>
            <p class="lead">Search from our simple and clear way</p>
        </div>
    </div>
</div>

<div class="container text-center" style="width: 60%; margin-top: 2%">

    <input type="text" maxlength="200" class="form-control input-lg" id="pesquisa_text_title" placeholder="Search by Title">

    <div id="pesquisa_text_type"></div>

    <div class="pesquisa-control-title" data-info="<?= Url::toRoute(['tips/searchtitle']); ?>"></div>

</div>

<div class="row">
    <div class="col-xs-12">
        <h2>
            <?= Html::button('Add Tip', ['value' => Url::to(['tips/create?'.'&type=' . $title]), 'class'=>'btn btn-success', 'id' => 'modalBtnAddTip']) ?>
        </h2>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="card-blocks" id="blocks_search_body">

            <div id="pesquisa_button_edit" data-info="<?= Url::to(['tips/view?type=' . $title . '&id=']) ?>" />
            <div id="pesquisa_button_delete" data-info="<?= Url::to(['tips/delete?response=' . null . '&type=' . $title . '&id=']) ?>" />

            <?php foreach ( $data as $key => $record) {?>
                <div class="card-item panel", id="box_search">
                    <div class="card-head panel-heading" id="row_title"> <?= $record->title ?> <span class="pull-right"></spant></span></div>
                    <div class="card-body panel-body" style="text-align: justify" id="row_content"> <?= $record->content ?> </div>
                    <div class="card-foot panel-footer">
                        <?= Html::button('Edit', ['value' => Url::to(['tips/update?type=' . $title . '&id=' . $record->id]), 'class'=>'btn btn-primary btn-xs', 'id' => 'modalBtnEditTip']) ?>

                        <?= Html::button('Delete', ['value' => Url::to(['tips/delete?response=' . null . '&type=' . $title . '&id=' . $record->id]), 'class'=>'btn btn-danger btn-xs', 'id' => 'modalBtn']) ?>
                    </div>
                </div>
            <?php }?>
        </div>
    </div>
</div>

</div>
