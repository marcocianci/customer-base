<?php

namespace api\modules\v1\controllers;

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
    public $useAuthentication = false;

    public $modelClass = 'common\models\LegalPerson';

}
