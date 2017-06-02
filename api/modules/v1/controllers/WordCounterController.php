<?php
/**
 * Created by PhpStorm.
 * User: Freedom
 * Date: 30/05/2017
 * Time: 21:50
 */

namespace api\modules\v1\controllers;

use yii;
use MarcoCianci\WordCounter;

class WordCounterController extends BaseActiveController
{
    public function actions()
    {
        $actions = parent::actions();
        unset(
            $actions['index'],
            $actions['view'],
            $actions['create'],
            $actions['update'],
            $actions['delete']
        );
        return $actions;
    }

    public $modelClass = 'common\models\WordCounter';

    public function actionText(){


        if (!Yii::$app->request->isGet) {
            return false;
        }

        $text = Yii::$app->request->get('text',null);

        $wordCounter = new WordCounter;

        return [
            'total' => $wordCounter->wordCounter($text),
            'uniqueWordCounter' => $wordCounter->uniqueWordCounter($text)
        ];

    }
}