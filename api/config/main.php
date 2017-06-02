<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-api',
    'name' => 'Customer Base',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'api\controllers',
    'aliases'  => [
        // '@img' => dirname(__DIR__).'/web/img',
        '@api' => dirname(dirname(__DIR__)).'/api', // add api alias
    ],
    // 'bootstrap' => ['log'],
    'bootstrap'           => ['debug', 'log', 'common\extensions\ModuleBootstrap'],
    'modules' => [
        'gii'   => [
            'class'      => 'yii\gii\Module',
            'allowedIPs' => ['127.0.0.1', '::1', '192.168.*.*', '191.168.*.*'],
        ],
        'debug'             => [
            'class' => 'yii\debug\Module',
            'allowedIPs' => ['1.2.3.4', '127.0.0.1', '::1', '192.168.*.*','191.168.*.*']
        ],
        'v1'          => [
            'basePath'  => '@app/modules/v1',
            'class'     => 'api\modules\v1\Module',
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-api',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-api', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-api',
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
            'enableStrictParsing' => true,

            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'pluralize' => false,
                    'controller' =>
                        [
                            'v1/user',
                            'v1/legal-person',
                            'v1/natural-person',
                            'v1/word-counter',
                            //'',
                        ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'pluralize' => false,
                    'controller' => [ 'v1/word-counter', ],
                    'patterns' => [
                        'GET text'     => 'text',
                        'OPTIONS by-state'  => 'options',
                    ]
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
