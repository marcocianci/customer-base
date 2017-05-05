<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\NaturalPerson */

$this->title = 'Create Natural Person';
$this->params['breadcrumbs'][] = ['label' => 'Natural People', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="natural-person-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
