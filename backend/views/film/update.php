<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\film\film */

$this->title = 'Update Film: ' . $model->film->title;
$this->params['breadcrumbs'][] = ['label' => 'Films', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->film->title, 'url' => ['view', 'id' => $model->film->film_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="film-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
