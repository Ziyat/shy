<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/style.css',
        'css/bootstrap.min.css',
        'css/font-awesome.min.css',
    ];
    public $js = [
        'js/jquery-3.3.1.slim.min.js',
        'js/bootstrap.min.js',
    ];
    public $depends = [
    ];
}
