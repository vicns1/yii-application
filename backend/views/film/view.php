<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\film\film */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Films', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="film-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->film_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->film_id], [
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
            'film_id',
            'title',
            'description:ntext',
            'release_year',
            'language_id',
            'original_language_id',
            'rental_duration',
            'rental_rate',
            'length',
            'replacement_cost',
            'rating',
            'special_features',
            'last_update',
            'category_id',
        ],
    ]) ?>

</div>
