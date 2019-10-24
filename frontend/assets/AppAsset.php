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
        '/css/bootstrap.min.css',
        '/js/jquery-3.3.1.slim.min.js',
        '/js/bootstrap.min.js',
        '/css/font-awesome.min.css',
    ];
    public $js = [
    ];
    public $depends = [
    ];
}
