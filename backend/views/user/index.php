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

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title="Users Manager";
?>

<div class="container">

<?php

Modal::begin([
    'header' => '<h4>Warning! <br> <br> Are you sure you want to delete this user and all your dependencies? </h4>',
    'id' => 'modal',
    'size' => 'modal-s',
]);

echo "<div id='modalContent'></div>";

Modal::end();

?>

<?php

Modal::begin([
    'header' => '<h4>View User</h4>',
    'id' => 'modal_view',
    'size' => 'modal-lg',
]);

echo "<div id='modalContent'></div>";

Modal::end();

?>

<div class="row">
    <div class="col-xs-12">
        <div class="container text-center">
            <h2 class="page-header">Users Manager</h2>
            <p class="lead">Search from our simple and clear way</p>
        </div>
    </div>
</div>

<div class="container text-center" style="width: 60%; margin-top: 2%">

    <div class="input-group input-group-lg">

        <span class="input-group-btn">

        </span>

        <input type="text" maxlength="200" class="form-control" id="pesquisa_text" placeholder="Search">

        <div class="pesquisa-control" data-info="<?= Url::toRoute(['user/searchmail']); ?>"></div>

        <select id="pesquisa_como" class="selectpicker" data-style="btn-primary">
            <option value="ID">ID &nbsp</option>
            <option value="Username">Username &nbsp</option>
            <option value="Email">Email &nbsp</option>
        </select>

    </div>

</div>

<table class="table" id="table_search" style="margin-top: 5%">
    <thead>
    <tr>
        <th>Id</th>
        <th>Username</th>
        <th>Email</th>
        <th class="col-sm-2">Actions</th>
    </tr>
    </thead>
    <div id="pesquisa_button_view" data-info="<?= Url::to(['user/view?update=no&role='.null.'&id=']) ?>" />
    <div id="pesquisa_button_delete" data-info="<?= Url::to(['user/delete?response='. null . '&id=']) ?>" />
    <tbody id="table_search_body">
    <?php foreach ( $data as $key => $record) { ?>
        <tr id="row_search">
            <td id="row_id">
                <?= $record->Id ?>
            </td>
            <td id="row_user">
                <?= $record->username ?>
            </td>
            <td id="row_email">
                <?= $record->email ?>
            </td>
            <td>
                <?= Html::button('View', ['value' => Url::to(['user/view?update=no&role='.null.'&id=' . $record->Id]), 'class'=>'btn btn-warning btn-xs', 'id' => 'modalBtnView']) ?>

                <?= Html::button('delete', ['value' => Url::to(['user/delete?response=' . null . '&id=' . $record->Id]), 'class' => 'btn btn-danger btn-xs', 'id' => 'modalBtn']) ?>
            </td>
        </tr>
    <?php }?>
    </tbody>
</table>

</div>
