<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'qolwRyHiWnJYs5m1bxxzE92bXXVeN6dA',
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
        'homestead' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;port=3306;dbname=homestead',
            'username' => 'homestead',
            'password' => 'secret',
            'charset' => 'utf8',
        ],
        'homestead_local' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;port=33060;dbname=homestead',
            'username' => 'homestead',
            'password' => 'secret',
            'charset' => 'utf8',
        ],
    ],
    'params' => $params,
];



//if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config = array_merge_recursive($config, [
        'bootstrap' => ['debug'],
        'modules' => [
            'debug' => 'yii\debug\Module',
        ]
    ]);

    $config = array_merge_recursive($config, [
        'bootstrap' => ['gii'],
        'modules' => [
            'gii' => [
                'class' => 'yii\gii\Module',
                'allowedIPs' => ['*'] ,
                'generators' => [
                    'laravelModel' => [
                        'class' => 'app\laravel\model\Generator',
                        'templates' => [
                            'my' => '@app/laravel/model/default',
                        ],
                    ],
                ],
            ]
        ]
    ]);
//}

return $config;
