<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\LegalPerson */

$this->title = $model->social_name;
$this->params['breadcrumbs'][] = ['label' => 'Pessoa Juridica', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="legal-person-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Apagar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'social_name',
            'state_registration',
            'cnpj',
            'user_id',
            //'created_at',
            //'updated_at',
            [
                'attribute' => 'created_at',
                'format'    => [ 'date', 'php:d/m/Y H:i' ]
            ],
            [
                'attribute' => 'updated_at',
                'format'    => [ 'date', 'php:d/m/Y H:i' ]
            ],
        ],
    ]) ?>

</div>
