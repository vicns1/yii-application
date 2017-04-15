<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\customer\searchAddress */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Addresses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="address-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Address', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'address_id',
            'address',
            'city',
            'district',
            'postal_code',
            // 'last_update',
            // 'country_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
