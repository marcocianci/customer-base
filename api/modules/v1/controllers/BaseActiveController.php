<?php

namespace api\modules\v1\controllers;

use Yii;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\Cors;
use yii\rest\ActiveController;

/**
 * BaseActiveController controller
 */
class BaseActiveController extends ActiveController
{
    /*
     * @var boolean
     */
    public $useAuthentication = true;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['corsFilter'] = [
            'class' => Cors::className(),
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Allow-Origin' => ['*'],
                'Access-Control-Request-Method' => ['OPTIONS','GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD'],
                'Access-Control-Request-Headers' => ['*'],
                'Access-Control-Allow-Credentials' => true,
                'Access-Control-Max-Age' => 86400,
                'Access-Control-Expose-Headers' => ['X-Pagination-Current-Page'],
            ],
        ];
        if ((boolean)$this->useAuthentication) {
            $behaviors['authenticator'] = [
                'class'     => HttpBasicAuth::className(),
                'except'    => ['options']
            ];
        }
        return $behaviors;
    }

    public function init()
    {
        parent::init();
    }
}
