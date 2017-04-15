<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\customer\searchAddress */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="address-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'address_id') ?>

    <?= $form->field($model, 'address') ?>

    <?= $form->field($model, 'city') ?>

    <?= $form->field($model, 'district') ?>

    <?= $form->field($model, 'postal_code') ?>

    <?php // echo $form->field($model, 'last_update') ?>

    <?php // echo $form->field($model, 'country_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
