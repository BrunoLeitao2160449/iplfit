<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php

    if(Yii::$app->user->identity->auth->item_name == "admin"){

        NavBar::begin([
            'brandLabel' => Html::img('@web/images/fitlogo.png', ['alt'=>'IPLFit', 'width'=>35, 'height'=>31 ]),
            'brandUrl' => ['/user/index'],
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);

        $menuItems[] = [
            'label' => 'Tips',
            'items' => [
                ['label' => 'Health', 'url' => ['/tips/index', 'type' => 'Health']],
                ['label' => 'Recipes', 'url' => ['/tips/index', 'type' => 'Recipes']],
                ['label' => 'Sport', 'url' => ['/tips/index', 'type' => 'Sport']],
            ],
        ];

        $menuItems[] = ['label' => 'Users Manager', 'url' => ['/user/index']];
    }
    else{
        NavBar::begin([
            'brandLabel' => Html::img('@web/images/fitlogo.png', ['alt'=>'IPLFit', 'width'=>35, 'height'=>31 ]),
            'brandUrl' => ['../../frontend/web/'],
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);

    }

if (!Yii::$app->user->isGuest) {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer style="background-color: #151515; position: fixed; bottom: 0; left: 0; right: 0; height: 35px;text-align: center; color: #CCC ">
    <p style="padding: 10.5px; margin: 0px; line-height: 100%">
        © <?= date('Y') ?>
        <a style="color:#C84403; text-decoration:none;" href="../web/">
            IPLFit
        </a>
        , Bruno Leitão & Nelson Silva
    </p>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
