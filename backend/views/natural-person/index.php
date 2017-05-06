<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\NaturalPerson */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Natural People';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="natural-person-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Natural Person', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'cpf',
            'born_date',
            'rg',
            // 'user_id',
            // 'created_at',
            // 'updated_at',
            [
                'attribute' => 'created_at',
                'format'    => [ 'date', 'php:d/m/Y H:i' ]
            ],
            [
                'attribute' => 'updated_at',
                'format'    => [ 'date', 'php:d/m/Y H:i' ]
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
