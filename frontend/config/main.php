<?php

$params = array_merge(
   require(__DIR__ . '/../../common/config/params.php'),
   require(__DIR__ . '/../../common/config/params-local.php'),
   require(__DIR__ . '/params.php'),
   require(__DIR__ . '/params-local.php')
);

return [
   'id' => 'app-frontend',
   'basePath' => dirname(__DIR__),
   'controllerNamespace' => 'frontend\controllers',
   'components' => [
      'user' => [
         'identityClass' => 'common\models\User',
         'enableAutoLogin' => true,
      ],
      'log' => [
         'traceLevel' => YII_DEBUG ? 3 : 0,
         'targets' => [
            [
               'class' => 'yii\log\FileTarget',
               'levels' => ['error', 'warning'],
            ],
         ],
      ],
      'errorHandler' => [
         'errorAction' => 'site/error',
      ],
      'urlManager' => [
         'class' => 'codemix\localeurls\UrlManager',
         'enablePrettyUrl' => true,
         'showScriptName' => false,
         'enableStrictParsing' => true,
         'languages' => ['uz', 'ru'],
//         'ignoreLanguageUrlPatterns' => [
         // route pattern => url pattern
//            '#^error#' => '#^error#',
//         ],
         'rules' => [
            '' => 'site/index',
            'captcha' => 'site/captcha',
            '<_c:[\w\-]+>' => '<_c>/index',
            '<_c:[\w\-]+>/<id:[\d+]+>/<seria:[\d+]+>' => '<_c>/view',
            '<_c:[\w\-]+>/<id:[\d+]+>' => '<_c>/view',
            '<_c:[\w\-]+>/<_a:[\w-]+>' => '<_c>/<_a>',
         ],
      ],
   ],
   'params' => $params,
];
