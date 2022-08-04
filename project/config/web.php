<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'fileStore' => [
            'class' => \dicr\file\FileStore::class,
            'path' => '@webroot',
            'url' => '@web'
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '132',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'error/index',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'htmlLayout' => false,
            'textLayout' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.yandex.ru',
                'username' => 'y.smirnov@worksolutions.ru',
                'password' => 'knjkcnjuj315',
                'port' => '465',
                'encryption' => 'ssl'
            ]
        ],
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => 'redis',
            'port' => 6379,
            'database' => 0,
        ],
        'mongodb' => [
            'class' => '\yii\mongodb\Connection',
            'dsn' => 'mongodb://course:course@mongo:27017',
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
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'news/index',
                '<action:(login|register)>' => 'auth/<action>',
                'news/<id:\d+>' => 'news/show',
                'profile/<username:\w+>' => 'profile/show',
                'profile/<username:\w+>/news' => 'profile/news',
                'admin' => 'admin/main/index',
                'admin/news' => 'admin/news/index',
                'admin/users' => 'admin/users/index',
                'admin/news/<id:\d+>' => 'admin/news/show',
                'admin/news/<id:\d+>/edit' => 'admin/news/edit',
                'admin/users/<id:\d+>' => 'admin/users/show',
            ],
        ],
        'queue' => [
            'class' => \yii\queue\redis\Queue::class,
            'redis' => 'redis',
            'channel' => 'queue',
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
