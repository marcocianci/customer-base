<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\NaturalPerson */

$this->title = 'Criar Pessoa Fisica';
$this->params['breadcrumbs'][] = ['label' => 'Pessoa Fisica', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="natural-person-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
