<?php

namespace api\controllers;

use Yii;
use common\models\LegalPerson;
use common\models\search\LegalPerson as LegalPersonSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LegalPersonController implements the CRUD actions for LegalPerson model.
 */
class LegalPersonController extends BaseActiveController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

}
