<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/UsersControl.css',
        'css/tips.css',
        'css/template.css',
    ];
    public $js = [
        'js/modalFunc.js',
        'js/Search.js',
        'js/tips.js',
        'js/jquery.validate.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
