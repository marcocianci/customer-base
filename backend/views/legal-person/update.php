<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\LegalPerson */

$this->title = 'Atualizar Pessoa Juridica: ' . $model->social_name;
$this->params['breadcrumbs'][] = ['label' => 'Pessoa Juridica', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->social_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="legal-person-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
