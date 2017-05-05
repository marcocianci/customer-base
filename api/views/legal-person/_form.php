<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\LegalPerson */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="legal-person-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'social_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'state_registration')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cnpj')->textInput(['maxlength' => true]) ?>

    <?/*= $form->field($model, 'user_id')->textInput() */?>

    <?/*= $form->field($model, 'created_at')->textInput() */?>

    <?/*= $form->field($model, 'updated_at')->textInput() */?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
