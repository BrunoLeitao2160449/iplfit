<?php

use yii\bootstrap\Button;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>

<?php

    echo Html::a('Yes', ['user/delete', "id" => $id, "response" => "yes"], ['class' => 'btn btn-danger']);

    echo Html::a('No', ['user/delete', "id" => $id, "response" => "no"], ['class' => 'btn btn-primary', 'style' => 'margin-left: 1%']);
?>
