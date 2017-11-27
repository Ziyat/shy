<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ItemAsset extends AssetBundle {

   public $basePath = '@webroot';
   public $baseUrl = '@web';
   public $css = [
      'css/rating.css',
   ];
   public $js = [
      'js/jquery.gallery.js',
      'js/rating.js',
      'js/html5gallery.js',
      'js/star.js',
   ];
   public $depends = [
      'yii\web\JqueryAsset',
   ];

}
