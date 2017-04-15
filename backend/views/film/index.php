<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\utilities\ActorsColumn;

/* @var $this yii\web\View */
/* @var $searchModel common\models\film\filmsearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Films';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="film-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Film', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'film_id',
            'title',
            //'description:ntext',
            ['attribute' => 'category', 
             'value' => 'category.name'],
            'release_year',
             ['attribute' => 'language', 
              'value' => 'language.name',],
            ['class' => 'backend\utilities\ActorsColumn'],
              /*
             ['label' => 'Actors',
              'format' => 'paragraphs',
              'value' => function($model){
                $result ='';
                foreach ($model->actors as $actor) {
                    $result .= $actor->first_name." ".$actor->last_name ."\n\n";
                }
                return $result;
              }],
              */
             //'original_language_id',
             'rental_duration',
             'rental_rate',
             'hmlength',
             'replacement_cost',
             'rating',
             'special_features',
            // 'last_update',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
