<?php
/**
 * Created by PhpStorm.
 * User: b_ml_
 * Date: 21/11/2017
 * Time: 09:54
 */

use yii\helpers\Url; ?>


<div class="container">
    <div class="row">
        <div class="col-xs-12">
                <div class="container text-center">
                    <h2 class="page-header">Users Manager</h2>
                    <p class="lead">Search from our simple and clear way</p>
            </div>
        </div>
    </div>

    <br><br>

    <div class="container text-center" style="width: 60%">

        <div class="input-group input-group-lg">
            
            <span class="input-group-btn">
                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="adv-search-drop">
                    <i class="glyphicon glyphicon-chevron-down"></i>
                </button>

                <ul class="dropdown-menu">
                    <li>
                        <a role="button" >
                            ID
                        </a>
                    </li>
                    <li>
                        <a role="button">
                            Name
                        </a>
                    </li>
                    <li>
                        <a role="button">
                            Username
                        </a>
                    </li>
                    <li>
                        <a role="button">
                            Email
                        </a>
                    </li>
                </ul>

            </span>
                <input type="text" maxlength="200" class="form-control" placeholder="Name">

                <span class="input-group-btn">
                <button class="btn btn-primary" type="button" id="nlk-search-submit">
                <i class="glyphicon glyphicon-search"></i>
            </button>

            </span>

        </div>

    </div>

    <br><br>

    <div class="row">
        <div class="col-xs-12">
            <div class="card-blocks ">

                <?php foreach($utilizadores as $u): ?>

                    <div class="well">
                        <div class="card-item panel well">

                            <div class="pricing-table-holder">
                                <center>
                                    <h4 style="font-weight: bold"><?= $u->Nome; ?></h4>
                            </div>

                            <div class="pricing-feature-list">
                                <ul class="list-group">
                                    <li class="list-group-item" style="font-weight: bold"> ID <span style="font-weight: normal"><?= $u->id_user; ?></span></li>
                                    <li class="list-group-item" style="font-weight: bold"> Username <span style="font-weight: normal"><?= $u->Username; ?></span></li>
                                    <li class="list-group-item" style="font-weight: bold"> Email <span style="font-weight: normal"><?= $u->Email; ?></span></li>
                                    <li class="list-group-item" style="font-weight: bold"> Birthday Date <span style="font-weight: normal"><?= $u->Data_de_Nascimento; ?></span></li>
                                </ul>
                            </div>

                            <div class="pricing-table-holder">
                                <center>
                                    <p style="align-items: center">
                                        <a>
                                            <button type="button" class="btn btn-primary btn-group-sm glyphicon glyphicon-list">
                                                <b style="font-size: large"> Details </b>
                                            </button>
                                        </a>

                                        <a href="<?= Url::toRoute(['site/deleteuser', "id" => $u->id_user]) ?>">
                                            <button type="button" class="btn btn-danger btn-group-sm glyphicon glyphicon-trash">
                                                <b style="font-size: large"> Delete </b>
                                            </button>
                                        </a>
                                    </p>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>

            </div>
        </div>
    </div>
</div>

