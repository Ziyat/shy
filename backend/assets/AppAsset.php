<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/bower_components';
    public $js = [
    ];
    public $css = [
        'Ionicons/css/ionicons.min.css',
    ];
    public $depends = [
        'dmstr\web\AdminLteAsset',
    ];
}
