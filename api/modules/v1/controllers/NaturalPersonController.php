<?php

namespace api\modules\v1\controllers;

use Yii;
use common\models\NaturalPerson;
use common\models\search\NaturalPerson as NaturalPersonSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NaturalPersonController implements the CRUD actions for NaturalPerson model.
 */
class NaturalPersonController extends BaseActiveController
{

    public $useAuthentication = false;

    public $modelClass = 'common\models\NaturalPerson';


}
