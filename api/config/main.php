<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'name' => 'Customer Base',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'gii'   => [
            'class'      => 'yii\gii\Module',
            'allowedIPs' => ['127.0.0.1', '::1', '192.168.*.*', '191.168.*.*'],
        ],
        'debug'             => [
            'class' => 'yii\debug\Module',
            'allowedIPs' => ['1.2.3.4', '127.0.0.1', '::1', '192.168.*.*','191.168.*.*']
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'pluralize' => false,
                    'controller' =>
                        [
                            'user',
                            'legal-person',
                            'natural-person',
                            //'',
                        ],
                ],
            ],
        ],

        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],

    ],
    'params' => $params,
];
