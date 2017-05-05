<?php

namespace api\modules\v1\controllers;


use api\models\forms\UpdatePasswordForm;
use common\models\User;
use yii\web\BadRequestHttpException;

class UserController extends BaseActiveController
{

    public $modelClass = 'common\models\User';
    public $useAuthentication = true;

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create'], $actions['update'], $actions['delete'], $actions['index'], $actions['view']);
        return $actions;
    }

    public function actionUpdate($id)
    {
        $model = User::findOne(['id' => \Yii::$app->user->id]);
        $model->setScenario(User::SCENARIO_REST_UPDATE);
        if ($model->load(\Yii::$app->request->post(), '')) {
            if ($model->save()) {
                return 'Dados atualizados com sucesso.';
            } else{
                return $this->serializeData($model);
            }
        }
        throw new BadRequestHttpException('Requisição inválida');
    }
    
    public function actionChangePass()
    {
        $passwordModel = new UpdatePasswordForm();

        if ($passwordModel->load(\Yii::$app->request->post(), '')) {
            if ($passwordModel->updatePassword()) {
                return 'Senha atualizada com sucesso.';
            } else{
                return $this->serializeData($passwordModel);
            }
        }
        throw new BadRequestHttpException('Requisição inválida');
    }
}
