<?php

namespace api\modules\v1\controllers;

use \common\models\forms\SignupForm;
use yii;
use common\models\forms\LoginForm;
use common\models\forms\PasswordResetRequestForm;
use common\models\User;

class AuthenticationController extends BaseActiveController
{
    public $useAuthentication = false;
    
    public $modelClass = 'common\models\User';

    public function actionLogin() {
        $model = new LoginForm();

        if($model->load(\Yii::$app->request->post(), '') && $model->login()){
            $user = User::findOne(['id' => \Yii::$app->user->id]);
            return $this->getRestUser($user);
        }
        
        $model->validate();
        return $this->serializeData($model);
    }

    public function actionSignup() {
        $model = new SignupForm();

        if($model->load(\Yii::$app->request->post(), '') && ($user = $model->signup()) instanceof User){
            /** @var User $user */
            return $this->getRestUser($user);
        }

        $model->validate();
        return $this->serializeData($model);
    }

    public function actionSignupFacebook() {
        if(Yii::$app->request->isPost && !is_null(Yii::$app->request->post("token", null))) {
            $model = new SignupForm();
            if(($user = $model->signupFacebook(Yii::$app->request->post("token"))) instanceof User){
                $arr = $this->getRestUser($user);
                $arr['firstTime'] = $model->isFirstLogin;
                return $arr;
            }else{
                return $this->serializeData($model);
            }
        } else {
            throw new yii\web\BadRequestHttpException('Erro no servidor');
        }
    }

    public function actionSignupGoogle() {
        if(Yii::$app->request->isPost && !is_null(Yii::$app->request->post("token", null))) {
            $model = new SignupForm();
            if(($user = $model->signupGoogle(Yii::$app->request->post("token"))) instanceof User){
                $arr = $this->getRestUser($user);
                $arr['firstTime'] = $model->isFirstLogin;
                return $arr;
            }else{
                return $this->serializeData($model);
            }
        } else {
            throw new yii\web\BadRequestHttpException('Erro no servidor');
        }
    }

    public function actionSignupTwitter() {
        if(Yii::$app->request->isPost
            && !is_null(Yii::$app->request->post("token", null))
            && !is_null(Yii::$app->request->post("secret", null)))
        {
            $model = new SignupForm();
            if(($user = $model->signupTwitter(Yii::$app->request->post("token"), Yii::$app->request->post("secret"))) instanceof User){
                $arr = $this->getRestUser($user);
                $arr['firstTime'] = $model->isFirstLogin;
                return $arr;
            }else{
                return $this->serializeData($model);
            }
        } else {
            throw new yii\web\BadRequestHttpException('Erro no servidor');
        }
    }

    public function actionRequestPasswordReset() {

        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post(), '') && $model->validate()) {
            if ($model->sendEmail()) {
                return ['success' => true];
            }else{
                throw new yii\web\BadRequestHttpException('Falha no sistema');
            }
        }

        $model->validate();
        return $this->serializeData($model);
    }

    /**
     * @param User $user
     * @return array
     */
    public function getRestUser($user) {
        return [
            'name'         => $user->name,
            'email'        => $user->email,
            'access_token' => base64_encode($user->access_token.':'),
        ];
    }
}
