<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\NaturalPerson */

$this->title = 'Atualizar Pessoa Fisica: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pessoa Fisica', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="natural-person-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
