<?php

$params = require(__DIR__ . '/params.php');

$config = [

    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [


        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 's',
            'baseUrl'=>'',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\Author',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
//        'mail' => [
//            'class' => 'yii\swiftmailer\Mailer',
//            'viewPath' => '@app/mail',
//            'htmlLayout' => 'layouts/main-html',
//            'textLayout' => 'layouts/main-text',
//            'messageConfig' => [
//                'charset' => 'UTF-8',
//                'from' => ['seroj97@bk.ru' => 'Yii2 Name'],
//            ],
//            'useFileTransport' => true,
//        ],

        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'serojmkhitaryan@gmail.com',
                'password' => 'seroj97@bk.ruu',
                'port' => '587',
                'encryption' => 'tls',
            ],
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
        'db' => require(__DIR__ . '/db.php'),

//        'urlManager' => [
//            'enablePrettyUrl' => true,
//            'showScriptName' => false,
//            'rules' => [
//            ],
//        ],


'urlManager' => [
    'class' => 'yii\web\UrlManager',
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
        ''=>'site/index',
        '<action:(index|login|logout)>'=>'site/<action>',
        '<controller:\w+>/<id:\d+>' => '<controller>/view',
        '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
        '<controller:\w+>/<action:\w+>' => '<controller>/<action>'
    ],
],

'view' => [
    'theme' => [
        'pathMap' => ['@app/views' => '@app/themes/adminLTE'],
        'baseUrl' => '@web/../themes/adminLTE',
    ],
],
        'gridview' => ['class' => 'kartik\grid\Module'],

    ],
    'modules' => [
        'gridview' => [
            'class' => '\kartik\grid\Module',
        ]],

    'params' => $params,

    'layout'=>'column2',
    'layoutPath'=>'@app/themes/adminLTE/layouts',
];


if (YII_ENV_DEV) {
//    // configuration adjustments for 'dev' environment
//    $config['bootstrap'][] = 'debug';
//    $config['modules']['debug'] = [
//        'class' => 'yii\debug\Module',
//    ];
//
//    $config['bootstrap'][] = 'gii';
//    $config['modules']['gii'] = [
//        'class' => 'yii\gii\Module',
//    ];


    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];$config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'generators' => [ //here
            'crud' => [ // generator name
                'class' => 'yii\gii\generators\crud\Generator', // generator class
                'templates' => [ //setting for out templates
                    'custom' => '@app/vendor/yiisoft/yii2-gii/generators/crud/custom', // template name => path to template
                ]
            ]
        ],
    ];
}


return $config;
