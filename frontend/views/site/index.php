<?php

/* @var $this yii\web\View */

use yii\bootstrap\Html;
use yii\bootstrap\Modal;
use yii\helpers\Url;

$this->title = 'IPLFit';
?>

<?php
Modal::begin([
    'header' => '<h4>Login</h4>',
    'id' => 'modal',
    'size' => 'modal-lg',
]);

echo "<div id='modalContent'></div>";

Modal::end();
?>


<div  style="background: url('../web/images/food5.jpg'); min-height: 800px;">
    <div class="container">

        <p style="margin-top: 100px; text-align: center">
            <a>
                <?= Html::button('Login', ['value' => Url::to(['site/login']), 'class'=>'btn btn-success btn-lg', 'id' => 'modalCreateCompany']) ?>
            </a>

            <a >
                <button type="button" class="btn btn-info btn-lg">
                    <b style="font-size: large"> Signup </b>
                </button>
            </a>
        </p>

        <p style="margin-top: 20px; font-size: 65px; font-weight: 700; text-align: center; color: #151515"> Lose Weight with
            <span style="margin-top: 150px; font-size: 65px; font-weight: 700; text-align: center; color: #C84403">
                IPLFit
            </span> !</p>
        <h2 class="bigpixi_head"></h2>
        <h3 style="text-align: center; font-weight: 700; font-size: 30px;color: #151515">The fastest, easiest to use calorie counter app. </h3>

        <div id="services" class="container-fluid tbpadding text-center ">
            <div class="row">
                <img src='../web/images/playButton.png' width="50px">
                <h4 style="font-weight: 700; font-size: 33px; color: #151515">Download now the APP</h4>
                <a style="font-weight: 700; font-size: 33px; color: black;">
                        "IPLFit"
                </a>

                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>



            </div>
        </div>
    </div>
</div>

<div class="container">

    <h2 class="bigpixi_head"><span>How does</span> IPLFit <span>work?</span></h2>

    <h3 style="text-align: center">
        People who record their intake of food eaten double the weight loss on average. Members lose weight 3x faster when they do it with friends. IPLFit combines these characteristics to create the most powerful solution for a sustainable and healthy weight loss.
    </h3>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <h2 class="bigpixi_head"><span>What are the tools to achieve your goals?</h2>

    <table class="table">
        <tr>
            <td>
                <h3>
                    <img src="../web/images/check.png">
                </h3>
            </td>
            <td>
                <h3 style="text-align: left">
                    A food diary to keep track of what you are about to consume.
                </h3>
            </td>
            <td>
                <h3>
                    <img src="../web/images/check.png">
                </h3>
            </td>
            <td>
                <h3 style="text-align: left">
                    A great collection of healthy recipes for your diet.
                </h3>
            </td>
        </tr>
        <tr>
            <td>
                <h3>
                    <img src="../web/images/check.png">
                </h3>
            </td>
            <td>
                <h3 style="text-align: left">
                    Nutrition Info for all foods, brands and restaurants.
                </h3>
            </td>
            <td>
                <h3>
                    <img src="../web/images/check.png">
                </h3>
            </td>
            <td>
                <h3 style="text-align: left">
                    An exercise diary to record all the calories you burn.
                </h3>
            </td>
        </tr>
        <tr>
            <td>
                <h3>
                    <img src="../web/images/check.png">
                </h3>
            </td>
            <td>
                <h3 style="text-align: left">
                    A weight chart and a newspaper to record your progress.
                </h3>
            </td>
            <td>
                <h3>
                    <img src="../web/images/check.png">
                </h3>
            </td>
            <td>
                <h3 style="text-align: left">
                    Mobile application for android.
                </h3>
            </td>
        </tr>
    </table>
</div>
