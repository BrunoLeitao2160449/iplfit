<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>

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

        <input type="text" maxlength="200" class="form-control" id="pesquisa_text">

        <div class="pesquisa-control" data-info="<?= Url::toRoute(['user/searchmail']); ?>"></div>
        <span class="input-group-btn">

                <button class="btn btn-primary" type="button" id="nlk-search-submit">
                <i class="glyphicon glyphicon-search"></i>
            </button>

            </span>

        <select id="pesquisa_como" class="selectpicker">
            <option value="ID">ID</option>
            <option value="Username">Username</option>
            <option value="Email">Email</option>
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
    <div id="pesquisa_button_view" data-info="<?= Url::to(['user/view?id=']) ?>" />
    <div id="pesquisa_button_delete" data-info="<?= Url::to(['user/delete?id=']) ?>" />
    <tbody id="table_search_body">
    <?php foreach ( $data as $key => $record) {?>
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
                <?= Html::button('View', ['value' => Url::to(['user/view?id=' . $record->Id . '&update=no' . '&role='.null]), 'class'=>'btn btn-warning btn-xs', 'id' => 'modalBtnView']) ?>

                <?= Html::button('delete', ['value' => Url::to(['user/delete?id='.$record->Id.'&response='.null]), 'class'=>'btn btn-danger btn-xs', 'id' => 'modalBtn']) ?>
            </td>
        </tr>
    <?php }?>
    </tbody>
</table>
