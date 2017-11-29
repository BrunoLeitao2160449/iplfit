<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>

<div class="row">
    <div class="col-xs-12">
        <div class="container text-center">
            <h2 class="page-header">Users Manager</h2>
            <p class="lead">Search from our simple and clear way</p>
        </div>
    </div>
</div>

<table class="table">
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
                <a href="<?=Url::toRoute(["user/delete", "id" => $record->Id])?>">
                    <button type="button" class="btn btn-danger btn-xs">
                        <b> Delete </b>
                    </button>
                </a>
                <!--<router-link class="btn btn-warning btn-xs" v-bind:to="{name: 'product-edit', params: {product_id: product.id}}">Edit</router-link>
                <router-link class="btn btn-danger btn-xs" v-bind:to="{name: 'product-delete', params: {product_id: product.id}}">Delete</router-link>-->
            </td>
        </tr>
    <?php }?>
    </tbody>
</table>
</div>
