<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

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


        <input type="text" maxlength="200" class="form-control" placeholder="Email">

        <span class="input-group-btn">
                <button class="btn btn-primary" type="button" id="nlk-search-submit">
                <i class="glyphicon glyphicon-search"></i>
            </button>

            </span>

    </div>

</div>

<table class="table" style="margin-top: 5%">
    <thead>
    <tr>
        <th>Id</th>
        <th>Username</th>
        <th>Email</th>
        <th class="col-sm-2">Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ( $data as $key => $record) {?>
        <tr>
            <td>
                <?= $record->Id ?>
            </td>
            <td>
                <?= $record->username ?>
            </td>
            <td>
                <?= $record->email ?>
            </td>
            <td>
                <a href="<?=Url::toRoute(["user/view", "id" => $record->Id])?>">
                    <button type="button" class="btn btn-warning btn-xs">
                        <b > View </b>
                    </button>
                </a>

                <?= Html::button('delete', ['value' => Url::to(['user/delete?id='.$record->Id.'&response='.null]), 'class'=>'btn btn-danger btn-xs', 'id' => 'modalBtn']) ?>
            </td>
        </tr>
    <?php }?>
    </tbody>
</table>
</div>
