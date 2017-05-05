<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\LegalPerson */

$this->title = 'Create Legal Person';
$this->params['breadcrumbs'][] = ['label' => 'Legal People', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="legal-person-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
