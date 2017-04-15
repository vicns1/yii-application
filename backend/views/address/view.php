<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\customer\Address */

$this->title = $model->address_id;
$this->params['breadcrumbs'][] = ['label' => 'Addresses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="address-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->address_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->address_id], [
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
            'address_id',
            'address',
            'city',
            'district',
            'postal_code',
            'last_update',
            'country_id',
        ],
    ]) ?>

</div>
