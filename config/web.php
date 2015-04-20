<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'lajayuhniyarsyah',
        ],
        'formatter'=>[
            'dateFormat' => 'dd-MMM-yyyy',
            'decimalSeparator'=>',',
            'thousandSeparator'=>'.',
            'currencyCode'=>"IDR"
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'numericLib'=>[
            'class'=>'app\components\NumericLib',
        ],
        'urlManager'=>[
            'enablePrettyUrl'=>true,
            'rules'=>[

                'invoice/<type:(in|out)>/<uid:\d+>'         => 'account-invoice/index',
                '<controller:\w+>/<action:\w+>/<uid:\d+>'   => '<controller>/<action>',
                'invoice/dashboard'                         => 'account-invoice/dashboard',
                'sale-order/<action:\w+>/<uid:\d+>'         => 'sale-order/<action>'
            ]
        ]
    ],
    'modules'=>[
        'gridview'=>[
            'class'=>'\kartik\grid\Module',
        ]
    ],

    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';

    // $config['modules']['debug'] = 'yii\debug\Module';
    $config['modules']['debug'] = [
        'class'=>'yii\debug\Module',
        'allowedIPs'=>['127.0.0.1','::1','10.36.15.18','192.168.9.25']
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
